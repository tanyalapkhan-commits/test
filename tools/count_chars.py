#!/usr/bin/env python3
"""
Считает объём текста каждой страницы в знаках без пробелов (без HTML-тегов и шорткодов).

Запуск: python3 tools/count_chars.py [--min 20000]
"""
import html
import os
import re
import sys

ROOT = os.path.join(os.path.dirname(__file__), '..', 'wp-content', 'themes', 'kabelpro', 'content', 'pages')
MIN = 20000
if '--min' in sys.argv:
    MIN = int(sys.argv[sys.argv.index('--min') + 1])


def count(text):
    text = re.sub(r'^\s*<!--.*?-->', '', text, count=1, flags=re.S)
    text = re.sub(r'\[[^\]]+\]', '', text)
    text = re.sub(r'<[^>]+>', '', text)
    text = html.unescape(text)
    return len(re.sub(r'\s+', '', text))


rows = []
for dirpath, _, files in os.walk(ROOT):
    if 'index.html' in files:
        with open(os.path.join(dirpath, 'index.html'), encoding='utf-8') as fh:
            rows.append((os.path.relpath(dirpath, ROOT), count(fh.read())))

rows.sort()
total = 0
short = 0
for path, n in rows:
    total += n
    flag = '' if n >= MIN else '  <-- меньше %d' % MIN
    short += 1 if flag else 0
    print('%8d  %s%s' % (n, path, flag))
print('-' * 60)
print('Страниц: %d, всего знаков без пробелов: %d, ниже нормы: %d' % (len(rows), total, short))
