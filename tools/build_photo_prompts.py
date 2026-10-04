#!/usr/bin/env python3
"""
Собирает docs/photo-prompts.md из data/photo-plan.json:
20 готовых промптов (по одному на полотно 3×2 = 6 фото), таблица соответствия
«полотно → позиция → слот → страница сайта → alt».

Запуск: python3 tools/build_photo_prompts.py
"""
import json
import os
import re

BASE = os.path.join(os.path.dirname(__file__), '..')
THEME = os.path.join(BASE, 'wp-content', 'themes', 'kabelpro')
PLAN = os.path.join(THEME, 'data', 'photo-plan.json')
PAGES = os.path.join(THEME, 'content', 'pages')
OUT = os.path.join(BASE, 'docs', 'photo-prompts.md')

POS = ['верх-лево', 'верх-центр', 'верх-право', 'низ-лево', 'низ-центр', 'низ-право']


def slot_usage():
    """slot -> список страниц, где он используется (обложка или [photo])."""
    usage = {}
    for dirpath, _, files in os.walk(PAGES):
        if 'index.html' not in files:
            continue
        rel = '/' + os.path.relpath(dirpath, PAGES).replace(os.sep, '/') + '/'
        if rel == '/glavnaya/':
            rel = '/'
        with open(os.path.join(dirpath, 'index.html'), encoding='utf-8') as fh:
            text = fh.read()
        m = re.search(r'"photo":\s*"([^"]+)"', text)
        if m:
            usage.setdefault(m.group(1), []).append(rel + ' (обложка)')
        for s in re.findall(r'slots?="([^"]+)"', text):
            for one in s.split(','):
                usage.setdefault(one.strip(), []).append(rel)
    # Слоты, которые выводятся шаблонами напрямую.
    for s in ('home-hero', 'home-winch-diesel', 'home-rent', 'home-service', 'home-training'):
        usage.setdefault(s, []).append('/ (шаблон главной)')
    usage.setdefault('contacts-office', []).append('/kontakty/ и страницы городов')
    usage.setdefault('contacts-warehouse', []).append('страницы городов')
    return usage


def main():
    with open(PLAN, encoding='utf-8') as fh:
        plan = json.load(fh)

    usage = slot_usage()
    slots = [p['slot'] for c in plan['canvases'] for p in c['photos']]
    assert len(slots) == len(set(slots)), 'Слоты повторяются'

    lines = []
    lines.append('# Фото для сайта: 20 полотен × 6 фото = 120 изображений\n')
    lines.append('Как пользоваться:\n')
    lines.append('1. Скопируйте промпт полотна в ChatGPT (генерация изображений) или другой генератор. '
                 'Просите максимальное разрешение, затем при необходимости увеличьте до 8K (7680×4320) апскейлером.')
    lines.append('2. Сохраните результат как `canvases/canvas-01.png` … `canvases/canvas-20.png` (номер = номер полотна).')
    lines.append('3. Запустите `python3 tools/slice_canvases.py` — скрипт разрежет каждое полотно на 6 фото, '
                 'назовёт их по слотам и сохранит в `wp-content/themes/kabelpro/assets/img/photos/` в формате WebP.')
    lines.append('4. Загрузите папку темы на хостинг — фото сразу появятся на нужных страницах (alt-тексты подставятся автоматически).\n')
    lines.append('Если генератор нарисовал на полотне надписи или логотипы — перегенерируйте полотно: '
                 'текст на фото портит впечатление и мешает SEO.\n')
    lines.append('Отдельное фото можно заменить вручную: положите файл `<слот>.jpg` или `<слот>.webp` в '
                 '`wp-content/uploads/kp-photos/` (переживёт обновление темы) или в папку `assets/img/photos/` темы.\n')
    lines.append('---\n')

    for canvas in plan['canvases']:
        n = canvas['id']
        lines.append('## Полотно %02d — %s\n' % (n, canvas['theme']))
        lines.append('Файл: `canvases/canvas-%02d.png`\n' % n)
        prompt = [
            'Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), '
            'divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, '
            'separated by thin straight white gutters (about 1% of the width). '
            'Each cell is an independent photo with its own composition; nothing crosses the gutters.',
            '',
            'Global style for all six photos: ' + plan['style'],
            '',
        ]
        for i, photo in enumerate(canvas['photos']):
            prompt.append('Photo %d (%s): %s' % (i + 1, ['top-left', 'top-center', 'top-right', 'bottom-left', 'bottom-center', 'bottom-right'][i], photo['scene']))
        prompt.append('')
        prompt.append('Remember: no text, no numbers, no logos, no watermarks in any of the six photos.')
        lines.append('```text\n' + '\n'.join(prompt) + '\n```\n')
        lines.append('| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |')
        lines.append('|---|---|---|---|---|')
        for i, photo in enumerate(canvas['photos']):
            where = ', '.join(usage.get(photo['slot'], ['— (резерв)']))
            lines.append('| %d | %s | `%s` | %s | %s |' % (i + 1, POS[i], photo['slot'], where, photo['alt']))
        lines.append('')

    unused = [s for s in slots if s not in usage]
    aliases_file = os.path.join(THEME, 'data', 'photo-aliases.json')
    aliases = json.load(open(aliases_file, encoding='utf-8')) if os.path.exists(aliases_file) else {}
    for a, target in aliases.items():
        if a in usage:
            usage.setdefault(target, []).extend(u + ' (замена для %s)' % a for u in usage[a])
    missing = sorted(set(usage) - set(slots) - set(aliases))
    lines.append('---\n')
    lines.append('Всего слотов: %d. Без привязки к странице (резерв): %d. Слотов на сайте без промпта: %d.\n'
                 % (len(slots), len(unused), len(missing)))
    if missing:
        lines.append('Слоты без промпта: ' + ', '.join('`%s`' % s for s in missing) + '\n')

    os.makedirs(os.path.dirname(OUT), exist_ok=True)
    with open(OUT, 'w', encoding='utf-8') as fh:
        fh.write('\n'.join(lines))
    print('OK: %s, слотов %d, резерв %d, без промпта %d' % (OUT, len(slots), len(unused), len(missing)))
    if unused:
        print('Резерв:', ', '.join(unused))
    if missing:
        print('Без промпта:', ', '.join(missing))


if __name__ == '__main__':
    main()
