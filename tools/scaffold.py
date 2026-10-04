#!/usr/bin/env python3
"""
Создаёт заготовки страниц (папки + index.html с JSON-шапкой) по дереву ниже.
Существующие файлы НЕ перезаписываются — скрипт безопасно запускать повторно,
он только добавит новые страницы, если дерево расширено.

Запуск: python3 tools/scaffold.py
"""
import json
import os

ROOT = os.path.join(os.path.dirname(__file__), '..', 'wp-content', 'themes', 'kabelpro', 'content', 'pages')

# (slug, title, menu, photo, schema, children)
TREE = [
    ('glavnaya', 'Оборудование для прокладки кабеля', False, 'home-hero', '', []),
    ('oborudovanie', 'Оборудование для прокладки кабеля', 'Оборудование', 'eq-hub', 'product', [
        ('kabelnye-lebedki', 'Кабельные лебедки', 'Кабельные лебедки', 'winch-hub', 'product', [
            ('benzinovye', 'Бензиновые кабельные лебедки', 'Бензиновые', 'winch-petrol-1', 'product', [
                ('do-1-tonny', 'Бензиновые лебедки до 1 тонны', 'До 1 т — сети 0,4 кВ', 'winch-petrol-small', 'product', []),
                ('1-3-tonny', 'Бензиновые кабельные лебедки 1–3 тонны', '1–3 т — сети 6–35 кВ', 'winch-petrol-3t', 'product', []),
                ('dlya-vols', 'Бензиновые лебедки для протяжки оптического кабеля', 'Для ВОЛС', 'winch-petrol-fiber', 'product', []),
            ]),
            ('dizelnye', 'Дизельные кабельные лебедки', 'Дизельные', 'winch-diesel-1', 'product', [
                ('3-5-tonn', 'Дизельные кабельные лебедки 3–5 тонн', '3–5 т', 'winch-diesel-5t', 'product', []),
                ('5-10-tonn', 'Дизельные кабельные лебедки 5–10 тонн', '5–10 т', 'winch-diesel-10t', 'product', []),
                ('10-20-tonn', 'Дизельные лебедки 10–20 тонн для кабелей 110–500 кВ', '10–20 т — 110–500 кВ', 'winch-diesel-20t', 'product', []),
                ('na-pricepe', 'Дизельные кабельные лебедки на прицепе', 'На прицепе', 'winch-diesel-trailer', 'product', []),
            ]),
            ('elektricheskie', 'Электрические кабельные лебедки', 'Электрические', 'winch-electric', 'product', []),
            ('gidravlicheskie', 'Гидравлические кабельные лебедки', 'Гидравлические', 'winch-hydraulic', 'product', []),
            ('kapstannye-i-barabannye', 'Капстанные и барабанные лебедки: устройство и выбор', 'Капстанные и барабанные', 'winch-capstan', 'article', []),
        ]),
        ('kabelnye-pricepy', 'Прицепы для кабельных барабанов', 'Кабельные прицепы', 'trailer-hub', 'product', [
            ('dorozhnye', 'Дорожные прицепы-барабановозы', 'Дорожные прицепы', 'trailer-road', 'product', []),
            ('gidravlicheskie', 'Гидравлические кабельные прицепы с самопогрузкой', 'С гидравлической погрузкой', 'trailer-hydraulic', 'product', []),
            ('mnogobarabannye', 'Многобарабанные кабельные прицепы', 'Многобарабанные', 'trailer-multi', 'product', []),
        ]),
        ('domkraty-i-raskatchiki', 'Домкраты и раскаточные устройства для кабельных барабанов', 'Домкраты и раскатчики', 'jack-hub', 'product', [
            ('mekhanicheskie-domkraty', 'Механические домкраты для кабельных барабанов', 'Механические домкраты', 'jack-mech', 'product', []),
            ('gidravlicheskie-domkraty', 'Гидравлические домкраты для кабельных барабанов', 'Гидравлические домкраты', 'jack-hydraulic', 'product', []),
            ('raskatochnye-ustrojstva', 'Раскаточные устройства и платформы для барабанов', 'Раскаточные устройства', 'jack-platform', 'product', []),
        ]),
        ('kabelnye-roliki', 'Кабельные ролики для прокладки кабеля', 'Кабельные ролики', 'roller-hub', 'product', [
            ('linejnye', 'Линейные кабельные ролики', 'Линейные ролики', 'roller-straight', 'product', []),
            ('uglovye', 'Угловые кабельные ролики', 'Угловые ролики', 'roller-corner', 'product', []),
            ('vhodnye-ustrojstva', 'Входные устройства и воронки для затягивания кабеля в трубы', 'Входные устройства', 'roller-entry', 'product', []),
        ]),
        ('kabelnye-tolkateli', 'Кабельные толкатели (тяговые машины)', 'Кабельные толкатели', 'pusher-1', 'product', []),
        ('uzk', 'Устройства закладки кабеля (УЗК)', 'УЗК', 'uzk-1', 'product', []),
        ('osnastka', 'Кабельные чулки, вертлюги и тяговые головки', 'Чулки и вертлюги', 'rigging-1', 'product', []),
        ('instrument', 'Инструмент для монтажа кабеля', 'Кабельный инструмент', 'tools-1', 'product', []),
        ('kontrol-tyazheniya', 'Динамометры и регистраторы тяжения кабеля', 'Контроль тяжения', 'gauge-1', 'product', []),
    ]),
    ('tekhnologii', 'Технологии прокладки кабеля', 'Технологии', 'tech-hub', 'article', [
        ('v-transhee', 'Прокладка кабеля в траншее', 'В траншее', 'tech-trench', 'article', [
            ('raskatka-po-rolikam', 'Раскатка кабеля по роликам в траншее', 'Раскатка по роликам', 'tech-trench-rollers', 'article', []),
            ('zashchita-i-zasypka', 'Защита кабеля в траншее и обратная засыпка', 'Защита и засыпка', 'tech-trench-backfill', 'article', []),
        ]),
        ('v-trubah', 'Прокладка кабеля в трубах и кабельной канализации', 'В трубах и канализации', 'tech-duct', 'article', [
            ('zatyagivanie-lebedkoj', 'Затягивание кабеля в трубы лебедкой', 'Затягивание лебедкой', 'tech-duct-winch', 'article', []),
        ]),
        ('gnb', 'Бестраншейная прокладка кабеля методом ГНБ', 'ГНБ', 'tech-hdd', 'article', []),
        ('vols', 'Прокладка оптического кабеля (ВОЛС)', 'Прокладка ВОЛС', 'tech-fiber', 'article', [
            ('pnevmoprokladka', 'Пневмопрокладка (задувка) оптического кабеля', 'Задувка кабеля', 'tech-blowing', 'article', []),
        ]),
        ('vysokovoltnye-kabeli', 'Прокладка кабелей 110–500 кВ', 'Кабели 110–500 кВ', 'tech-hv', 'article', []),
        ('kollektory-i-tonneli', 'Прокладка кабеля в коллекторах и тоннелях', 'Коллекторы и тоннели', 'tech-tunnel', 'article', []),
        ('estakady-i-lotki', 'Прокладка кабеля по эстакадам и в лотках', 'Эстакады и лотки', 'tech-tray', 'article', []),
        ('zimnyaya-prokladka', 'Прокладка кабеля при низких температурах', 'Зимняя прокладка', 'tech-winter', 'article', []),
        ('raschet-tyazheniya', 'Расчёт усилия тяжения кабеля', 'Расчёт тяжения', 'tech-calc', 'article', []),
        ('normativy', 'Нормативы прокладки кабеля: ПУЭ, СП, ГОСТ', 'Нормативы', 'tech-norms', 'article', []),
    ]),
    ('arenda', 'Аренда оборудования для прокладки кабеля', 'Аренда', 'rent-hub', 'service', [
        ('lebedki', 'Аренда кабельной лебедки', 'Аренда лебедок', 'rent-winch', 'service', []),
        ('pricepy', 'Аренда прицепа для кабельных барабанов', 'Аренда прицепов', 'rent-trailer', 'service', []),
    ]),
    ('servis', 'Сервис оборудования для прокладки кабеля', 'Сервис', 'service-hub', 'service', [
        ('remont-lebedok', 'Ремонт и обслуживание кабельных лебедок', 'Ремонт лебедок', 'service-repair', 'service', []),
        ('obuchenie', 'Обучение и шеф-монтаж при прокладке кабеля', 'Обучение и шеф-монтаж', 'service-training', 'service', []),
    ]),
    ('otrasli', 'Отрасли: где применяется оборудование для прокладки кабеля', 'Отрасли', 'ind-hub', 'article', [
        ('energetika', 'Оборудование для прокладки кабеля в электроэнергетике', 'Электроэнергетика', 'ind-power', 'article', []),
        ('telekom', 'Оборудование для прокладки кабеля связи', 'Телеком и ВОЛС', 'ind-telecom', 'article', []),
        ('zheleznye-dorogi', 'Прокладка кабеля на железной дороге и в метро', 'Железные дороги и метро', 'ind-rail', 'article', []),
        ('neftegaz', 'Прокладка кабеля на объектах нефтегазовой отрасли', 'Нефтегаз', 'ind-oil', 'article', []),
        ('stroitelstvo', 'Прокладка кабеля в гражданском и промышленном строительстве', 'Строительство', 'ind-construction', 'article', []),
        ('vie', 'Прокладка кабеля на солнечных и ветровых электростанциях', 'СЭС и ВЭС', 'ind-renewables', 'article', []),
    ]),
    ('o-kompanii', 'О компании [brand]', 'О компании', 'about-1', '', [
        ('politika-konfidencialnosti', 'Политика конфиденциальности', False, '', '', []),
    ]),
    ('kontakty', 'Контакты: филиалы в России и странах СНГ', 'Контакты', '', '', []),
]


def write(path, slug, title, menu, photo, schema, order):
    folder = os.path.join(path, slug)
    os.makedirs(folder, exist_ok=True)
    file = os.path.join(folder, 'index.html')
    if os.path.exists(file):
        return False
    meta = {
        'title': title,
        'seo_title': '',
        'description': '',
        'keywords': '',
        'menu': menu,
        'order': order,
        'photo': photo,
        'schema': schema,
        'excerpt': '',
    }
    with open(file, 'w', encoding='utf-8') as fh:
        fh.write('<!--\n' + json.dumps(meta, ensure_ascii=False, indent=1) + '\n-->\n<p>Текст готовится.</p>\n')
    return True


def walk(nodes, path):
    created = 0
    for i, (slug, title, menu, photo, schema, kids) in enumerate(nodes):
        created += write(path, slug, title, menu, photo, schema, (i + 1) * 10)
        created += walk(kids, os.path.join(path, slug))
    return created


if __name__ == '__main__':
    n = walk(TREE, ROOT)
    print('Создано заготовок:', n)
