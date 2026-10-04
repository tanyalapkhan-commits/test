#!/usr/bin/env python3
"""
Нарезка полотен на отдельные фото.

Каждое полотно canvases/canvas-NN.(png|jpg|jpeg|webp) — сетка 3 колонки × 2 ряда.
Скрипт делит полотно на 6 равных ячеек, срезает белые разделители (автоматически
по яркости и ещё небольшой отступ с краёв), приводит фото к 16:9 или 4:3 по выбору
и сохраняет в WebP с именем слота из data/photo-plan.json.

Требуется Pillow:  pip install pillow
Запуск:            python3 tools/slice_canvases.py [--width 1920] [--quality 82] [--ratio 16:9] [--only 3,7]
"""
import argparse
import glob
import json
import os
import re
import sys

try:
    from PIL import Image, ImageOps
except ImportError:
    sys.exit('Нужна библиотека Pillow: pip install pillow')

BASE = os.path.join(os.path.dirname(__file__), '..')
THEME = os.path.join(BASE, 'wp-content', 'themes', 'kabelpro')
PLAN = os.path.join(THEME, 'data', 'photo-plan.json')
SRC = os.path.join(BASE, 'canvases')
DST = os.path.join(THEME, 'assets', 'img', 'photos')


def trim_light_border(img, threshold=235, max_frac=0.08):
    """Срезает светлые полосы-разделители по краям ячейки (не больше max_frac с каждой стороны)."""
    gray = ImageOps.grayscale(img)
    w, h = gray.size
    px = gray.load()

    def is_light_row(y):
        step = max(1, w // 200)
        vals = [px[x, y] for x in range(0, w, step)]
        return sum(v > threshold for v in vals) > 0.9 * len(vals)

    def is_light_col(x):
        step = max(1, h // 200)
        vals = [px[x, y] for y in range(0, h, step)]
        return sum(v > threshold for v in vals) > 0.9 * len(vals)

    top, bottom, left, right = 0, h - 1, 0, w - 1
    while top < h * max_frac and is_light_row(top):
        top += 1
    while bottom > h * (1 - max_frac) and is_light_row(bottom):
        bottom -= 1
    while left < w * max_frac and is_light_col(left):
        left += 1
    while right > w * (1 - max_frac) and is_light_col(right):
        right -= 1
    return img.crop((left, top, right + 1, bottom + 1))


def crop_ratio(img, ratio):
    w, h = img.size
    target = ratio[0] / ratio[1]
    if w / h > target:
        nw = int(h * target)
        x = (w - nw) // 2
        return img.crop((x, 0, x + nw, h))
    nh = int(w / target)
    y = (h - nh) // 2
    return img.crop((0, y, w, y + nh))


def main():
    ap = argparse.ArgumentParser()
    ap.add_argument('--width', type=int, default=1920, help='ширина итогового фото, px (по умолчанию 1920)')
    ap.add_argument('--quality', type=int, default=82, help='качество WebP (по умолчанию 82)')
    ap.add_argument('--ratio', default='16:9', help='соотношение сторон итоговых фото: 16:9, 4:3 или none')
    ap.add_argument('--inset', type=float, default=0.01, help='доп. отступ внутрь ячейки, доля (по умолчанию 0.01)')
    ap.add_argument('--only', default='', help='номера полотен через запятую, например 3,7')
    args = ap.parse_args()

    with open(PLAN, encoding='utf-8') as fh:
        plan = {c['id']: c for c in json.load(fh)['canvases']}

    only = {int(x) for x in args.only.split(',') if x.strip()}
    ratio = None if args.ratio == 'none' else tuple(int(x) for x in args.ratio.split(':'))
    os.makedirs(DST, exist_ok=True)

    files = sorted(glob.glob(os.path.join(SRC, 'canvas-*.*')))
    if not files:
        sys.exit('В папке canvases/ нет файлов canvas-NN.png — см. docs/photo-prompts.md')

    done = 0
    for path in files:
        m = re.search(r'canvas-(\d+)\.(png|jpe?g|webp)$', path, re.I)
        if not m:
            continue
        n = int(m.group(1))
        if only and n not in only:
            continue
        if n not in plan:
            print('! %s: полотна №%d нет в плане, пропуск' % (os.path.basename(path), n))
            continue

        img = Image.open(path).convert('RGB')
        W, H = img.size
        cw, ch = W / 3, H / 2
        for i, photo in enumerate(plan[n]['photos']):
            col, row = i % 3, i // 3
            box = (
                int(col * cw + cw * args.inset), int(row * ch + ch * args.inset),
                int((col + 1) * cw - cw * args.inset), int((row + 1) * ch - ch * args.inset),
            )
            cell = trim_light_border(img.crop(box))
            if ratio:
                cell = crop_ratio(cell, ratio)
            if cell.width > args.width:
                cell = cell.resize((args.width, int(cell.height * args.width / cell.width)), Image.LANCZOS)
            out = os.path.join(DST, photo['slot'] + '.webp')
            cell.save(out, 'WEBP', quality=args.quality, method=6)
            done += 1
            print('✓ полотно %02d, фото %d → %s (%d×%d)' % (n, i + 1, os.path.basename(out), cell.width, cell.height))

    print('Готово: %d фото в %s' % (done, os.path.relpath(DST, BASE)))


if __name__ == '__main__':
    main()
