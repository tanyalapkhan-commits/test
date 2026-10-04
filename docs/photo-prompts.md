# Фото для сайта: 20 полотен × 6 фото = 120 изображений

Как пользоваться:

1. Скопируйте промпт полотна в ChatGPT (генерация изображений) или другой генератор. Просите максимальное разрешение, затем при необходимости увеличьте до 8K (7680×4320) апскейлером.
2. Сохраните результат как `canvases/canvas-01.png` … `canvases/canvas-20.png` (номер = номер полотна).
3. Запустите `python3 tools/slice_canvases.py` — скрипт разрежет каждое полотно на 6 фото, назовёт их по слотам и сохранит в `wp-content/themes/kabelpro/assets/img/photos/` в формате WebP.
4. Загрузите папку темы на хостинг — фото сразу появятся на нужных страницах (alt-тексты подставятся автоматически).

Если генератор нарисовал на полотне надписи или логотипы — перегенерируйте полотно: текст на фото портит впечатление и мешает SEO.

Отдельное фото можно заменить вручную: положите файл `<слот>.jpg` или `<слот>.webp` в `wp-content/uploads/kp-photos/` (переживёт обновление темы) или в папку `assets/img/photos/` темы.

---

## Полотно 01 — Главная и производство

Файл: `canvases/canvas-01.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Дизельная кабельная лебедка на прицепе у траншеи с кабельными роликами
Photo 2 (top-center): Трасса кабельной линии: траншея с роликами и лебедка на прицепе, вид сверху
Photo 3 (top-right): Цех обслуживания и сборки кабельных лебедок
Photo 4 (bottom-left): Инженер компании и заказчик на объекте прокладки кабеля
Photo 5 (bottom-center): Сварка рамы кабельного оборудования в цеху
Photo 6 (bottom-right): Проверка лебедки на испытательном стенде перед отгрузкой

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `home-hero` | / (обложка), / (шаблон главной) | Дизельная кабельная лебедка на прицепе у траншеи с кабельными роликами |
| 2 | верх-центр | `tech-hub` | /tekhnologii/ (обложка) | Трасса кабельной линии: траншея с роликами и лебедка на прицепе, вид сверху |
| 3 | верх-право | `service-hub` | /servis/ (обложка) | Цех обслуживания и сборки кабельных лебедок |
| 4 | низ-лево | `about-3` | — (резерв) | Инженер компании и заказчик на объекте прокладки кабеля |
| 5 | низ-центр | `about-welding` | — (резерв) | Сварка рамы кабельного оборудования в цеху |
| 6 | низ-право | `about-4` | — (резерв) | Проверка лебедки на испытательном стенде перед отгрузкой |

## Полотно 02 — Бензиновые лебедки

Файл: `canvases/canvas-02.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Бензиновая кабельная лебедка у траншеи
Photo 2 (top-center): Монтажник анкерует бензиновую лебедку перед протяжкой кабеля в трубу
Photo 3 (top-right): Пульт бензиновой лебедки: манометр, рычаг скорости, аварийный останов
Photo 4 (bottom-left): Бензиновый кабестан с синтетическим канатом и ручной подтяжкой
Photo 5 (bottom-center): Витки синтетического каната на барабане кабестана
Photo 6 (bottom-right): Бензиновая барабанная лебедка на складе

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-petrol-1` | /oborudovanie/kabelnye-lebedki/benzinovye/ (обложка) | Бензиновая кабельная лебедка у траншеи |
| 2 | верх-центр | `winch-petrol-3t` | /oborudovanie/kabelnye-lebedki/benzinovye/1-3-tonny/ (обложка) | Монтажник анкерует бензиновую лебедку перед протяжкой кабеля в трубу |
| 3 | верх-право | `winch-petrol-3t-2` | /oborudovanie/kabelnye-lebedki/benzinovye/1-3-tonny/ | Пульт бензиновой лебедки: манометр, рычаг скорости, аварийный останов |
| 4 | низ-лево | `winch-petrol-small` | /oborudovanie/kabelnye-lebedki/benzinovye/do-1-tonny/ (обложка) | Бензиновый кабестан с синтетическим канатом и ручной подтяжкой |
| 5 | низ-центр | `winch-petrol-small-2` | /oborudovanie/kabelnye-lebedki/benzinovye/do-1-tonny/ | Витки синтетического каната на барабане кабестана |
| 6 | низ-право | `winch-petrol-2` | /oborudovanie/kabelnye-lebedki/benzinovye/ | Бензиновая барабанная лебедка на складе |

## Полотно 03 — Дизельные лебедки

Файл: `canvases/canvas-03.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Дизельная кабельная лебедка на прицепе на подстанции
Photo 2 (top-center): Оператор лебедки контролирует график тяжения на дисплее
Photo 3 (top-right): Протяжка кабеля в кабельный канал дизельной лебедкой со стрелой
Photo 4 (bottom-left): Кабельная лебедка на прицепе в транспортном положении за пикапом
Photo 5 (bottom-center): Тяжёлая кабельная лебедка на двухосном прицепе с выставленными опорами
Photo 6 (bottom-right): Регистратор тяжения на пульте лебедки и распечатка протокола

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-diesel-1` | /oborudovanie/kabelnye-lebedki/dizelnye/ (обложка) | Дизельная кабельная лебедка на прицепе на подстанции |
| 2 | верх-центр | `winch-diesel-20t-2` | /oborudovanie/kabelnye-lebedki/dizelnye/10-20-tonn/ | Оператор лебедки контролирует график тяжения на дисплее |
| 3 | верх-право | `winch-diesel-3` | /oborudovanie/kabelnye-lebedki/dizelnye/ | Протяжка кабеля в кабельный канал дизельной лебедкой со стрелой |
| 4 | низ-лево | `winch-diesel-trailer` | /oborudovanie/kabelnye-lebedki/dizelnye/na-pricepe/ (обложка) | Кабельная лебедка на прицепе в транспортном положении за пикапом |
| 5 | низ-центр | `winch-diesel-20t` | /oborudovanie/kabelnye-lebedki/dizelnye/10-20-tonn/ (обложка) | Тяжёлая кабельная лебедка на двухосном прицепе с выставленными опорами |
| 6 | низ-право | `gauge-2` | — (резерв) | Регистратор тяжения на пульте лебедки и распечатка протокола |

## Полотно 04 — Электрические и гидравлические лебедки

Файл: `canvases/canvas-04.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Электрическая кабельная лебедка в кабельном коллекторе
Photo 2 (top-center): Электрическая лебедка с направляющей стрелой в техническом помещении
Photo 3 (top-right): Электродвигатель и редуктор электрической лебедки
Photo 4 (bottom-left): Гидравлическая лебедка с отдельной гидростанцией
Photo 5 (bottom-center): Гидравлическая лебедка на автомобиле у кабельного колодца
Photo 6 (bottom-right): Гидрораспределитель и рукава высокого давления кабельной лебедки

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-electric` | /oborudovanie/kabelnye-lebedki/elektricheskie/ (обложка) | Электрическая кабельная лебедка в кабельном коллекторе |
| 2 | верх-центр | `winch-electric-tunnel` | /oborudovanie/kabelnye-lebedki/elektricheskie/ | Электрическая лебедка с направляющей стрелой в техническом помещении |
| 3 | верх-право | `winch-electric-2` | /oborudovanie/kabelnye-lebedki/elektricheskie/ | Электродвигатель и редуктор электрической лебедки |
| 4 | низ-лево | `winch-hydraulic-2` | /oborudovanie/kabelnye-lebedki/gidravlicheskie/ | Гидравлическая лебедка с отдельной гидростанцией |
| 5 | низ-центр | `winch-hydraulic` | /oborudovanie/kabelnye-lebedki/gidravlicheskie/ (обложка) | Гидравлическая лебедка на автомобиле у кабельного колодца |
| 6 | низ-право | `service-repair` | /servis/remont-lebedok/ (обложка) | Гидрораспределитель и рукава высокого давления кабельной лебедки |

## Полотно 05 — Лебедки: обзор и детали

Файл: `canvases/canvas-05.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Кабельные лебедки разных классов на площадке склада
Photo 2 (top-center): Барабан лебедки со стальным канатом и тросоукладчиком
Photo 3 (top-right): Тяговый чулок и вертлюг на кабеле, проходящем по роликам
Photo 4 (bottom-left): Анкеровка кабельной лебедки забивными анкерами
Photo 5 (bottom-center): Ночная протяжка кабеля лебедкой на прицепе
Photo 6 (bottom-right): Калибровка датчика усилия на стенде

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-hub` | /oborudovanie/kabelnye-lebedki/ (обложка) | Кабельные лебедки разных классов на площадке склада |
| 2 | верх-центр | `winch-capstan-2` | /oborudovanie/kabelnye-lebedki/kapstannye-i-barabannye/ | Барабан лебедки со стальным канатом и тросоукладчиком |
| 3 | верх-право | `winch-hub-field` | /oborudovanie/kabelnye-lebedki/ | Тяговый чулок и вертлюг на кабеле, проходящем по роликам |
| 4 | низ-лево | `winch-diesel-trailer-2` | /oborudovanie/kabelnye-lebedki/dizelnye/na-pricepe/ | Анкеровка кабельной лебедки забивными анкерами |
| 5 | низ-центр | `winch-diesel-10t` | /oborudovanie/kabelnye-lebedki/dizelnye/5-10-tonn/ (обложка) | Ночная протяжка кабеля лебедкой на прицепе |
| 6 | низ-право | `service-repair-2` | — (резерв) | Калибровка датчика усилия на стенде |

## Полотно 06 — Оснастка: чулки и вертлюги

Файл: `canvases/canvas-06.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Кабельные чулки разных размеров
Photo 2 (top-center): Монтажник надевает тяговый чулок на кабель
Photo 3 (top-right): Тяговый чулок, закреплённый бандажом на кабеле
Photo 4 (bottom-left): Вертлюги для протяжки кабеля разных типоразмеров
Photo 5 (bottom-center): Соединение каната с тяговым чулком через вертлюг
Photo 6 (bottom-right): Нанесение смазки на кабель перед затягиванием в трубу

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `rigging-1` | /oborudovanie/osnastka/ (обложка) | Кабельные чулки разных размеров |
| 2 | верх-центр | `rigging-2` | — (резерв) | Монтажник надевает тяговый чулок на кабель |
| 3 | верх-право | `rigging-3` | — (резерв) | Тяговый чулок, закреплённый бандажом на кабеле |
| 4 | низ-лево | `rigging-swivels` | — (резерв) | Вертлюги для протяжки кабеля разных типоразмеров |
| 5 | низ-центр | `winch-hub-set` | /oborudovanie/kabelnye-lebedki/ | Соединение каната с тяговым чулком через вертлюг |
| 6 | низ-право | `tech-duct-winch-2` | — (резерв) | Нанесение смазки на кабель перед затягиванием в трубу |

## Полотно 07 — Домкраты для барабанов

Файл: `canvases/canvas-07.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Кабельный барабан на домкратах на строительной площадке
Photo 2 (top-center): Подъём барабана гидравлическим домкратом
Photo 3 (top-right): Механические винтовые домкраты с барабаном на оси
Photo 4 (bottom-left): Установка оси с конусом в кабельный барабан
Photo 5 (bottom-center): Подъём кабельного барабана краном с траверсой
Photo 6 (bottom-right): Оси и траверсы для кабельных барабанов на складе

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `jack-hub` | /oborudovanie/domkraty-i-raskatchiki/ (обложка) | Кабельный барабан на домкратах на строительной площадке |
| 2 | верх-центр | `jack-hydraulic` | /oborudovanie/domkraty-i-raskatchiki/gidravlicheskie-domkraty/ (обложка) | Подъём барабана гидравлическим домкратом |
| 3 | верх-право | `jack-mech` | /oborudovanie/domkraty-i-raskatchiki/mekhanicheskie-domkraty/ (обложка) | Механические винтовые домкраты с барабаном на оси |
| 4 | низ-лево | `jack-mech-2` | — (резерв) | Установка оси с конусом в кабельный барабан |
| 5 | низ-центр | `jack-crane` | — (резерв) | Подъём кабельного барабана краном с траверсой |
| 6 | низ-право | `jack-axles` | — (резерв) | Оси и траверсы для кабельных барабанов на складе |

## Полотно 08 — Раскаточные устройства и склад

Файл: `canvases/canvas-08.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Роликовая раскаточная платформа с пандусом для кабельного барабана
Photo 2 (top-center): Закатывание барабана на раскаточную платформу
Photo 3 (top-right): Ролик раскаточной платформы на подшипниковой опоре
Photo 4 (bottom-left): Передвижная стойка для кабельного барабана
Photo 5 (bottom-center): Стеллаж для размотки кабеля с нескольких катушек
Photo 6 (bottom-right): Склад кабельных барабанов

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `jack-platform` | /oborudovanie/domkraty-i-raskatchiki/raskatochnye-ustrojstva/ (обложка) | Роликовая раскаточная платформа с пандусом для кабельного барабана |
| 2 | верх-центр | `jack-platform-2` | — (резерв) | Закатывание барабана на раскаточную платформу |
| 3 | верх-право | `jack-platform-3` | — (резерв) | Ролик раскаточной платформы на подшипниковой опоре |
| 4 | низ-лево | `jack-stand-mobile` | — (резерв) | Передвижная стойка для кабельного барабана |
| 5 | низ-центр | `jack-rack` | — (резерв) | Стеллаж для размотки кабеля с нескольких катушек |
| 6 | низ-право | `about-2` | — (резерв) | Склад кабельных барабанов |

## Полотно 09 — Прицепы для барабанов

Файл: `canvases/canvas-09.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Прицеп-барабановоз с кабельным барабаном на трассе
Photo 2 (top-center): Раскатка кабеля с прицепа-барабановоза в траншею
Photo 3 (top-right): Кабельный прицеп с барабаном за пикапом
Photo 4 (bottom-left): Гидроцилиндр подъёма барабана на кабельном прицепе
Photo 5 (bottom-center): Прицеп с гидравлическими рычагами для самопогрузки барабана
Photo 6 (bottom-right): Трёхосный прицеп с приводом барабана на подстанции

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `trailer-road` | /oborudovanie/kabelnye-pricepy/dorozhnye/ (обложка), /oborudovanie/kabelnye-pricepy/dorozhnye/ | Прицеп-барабановоз с кабельным барабаном на трассе |
| 2 | верх-центр | `trailer-road-2` | /oborudovanie/kabelnye-pricepy/ | Раскатка кабеля с прицепа-барабановоза в траншею |
| 3 | верх-право | `trailer-hub` | /oborudovanie/kabelnye-pricepy/ (обложка) | Кабельный прицеп с барабаном за пикапом |
| 4 | низ-лево | `trailer-hydraulic-2` | /oborudovanie/kabelnye-pricepy/gidravlicheskie/ | Гидроцилиндр подъёма барабана на кабельном прицепе |
| 5 | низ-центр | `trailer-hydraulic` | /oborudovanie/kabelnye-pricepy/gidravlicheskie/ (обложка) | Прицеп с гидравлическими рычагами для самопогрузки барабана |
| 6 | низ-право | `trailer-heavy` | — (резерв) | Трёхосный прицеп с приводом барабана на подстанции |

## Полотно 10 — Кабельные ролики

Файл: `canvases/canvas-10.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Линейные кабельные ролики в траншее
Photo 2 (top-center): Линейный кабельный ролик
Photo 3 (top-right): Кабель на линейном ролике
Photo 4 (bottom-left): Угловой кабельный ролик на повороте траншеи
Photo 5 (bottom-center): Угловой кабельный ролик
Photo 6 (bottom-right): Линейные и угловые кабельные ролики на складе

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `roller-straight` | /oborudovanie/kabelnye-roliki/linejnye/ (обложка) | Линейные кабельные ролики в траншее |
| 2 | верх-центр | `roller-hub` | /oborudovanie/kabelnye-roliki/ (обложка) | Линейный кабельный ролик |
| 3 | верх-право | `roller-straight-2` | — (резерв) | Кабель на линейном ролике |
| 4 | низ-лево | `roller-corner` | /oborudovanie/kabelnye-roliki/uglovye/ (обложка) | Угловой кабельный ролик на повороте траншеи |
| 5 | низ-центр | `roller-corner-2` | — (резерв) | Угловой кабельный ролик |
| 6 | низ-право | `roller-assort` | — (резерв) | Линейные и угловые кабельные ролики на складе |

## Полотно 11 — Входные устройства

Файл: `canvases/canvas-11.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Роликовое устройство на краю кабельного колодца
Photo 2 (top-center): Монтажник вводит кабель в трубу через воронку в колодце
Photo 3 (top-right): Входная воронка и ролик для затягивания кабеля в трубу
Photo 4 (bottom-left): Раструб на входе кабеля в гофрированную трубу
Photo 5 (bottom-center): Установка роликового устройства на колодец
Photo 6 (bottom-right): Комплект воронок и роликов для протяжки кабеля

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `roller-entry-manhole` | — (резерв) | Роликовое устройство на краю кабельного колодца |
| 2 | верх-центр | `roller-entry` | /oborudovanie/kabelnye-roliki/vhodnye-ustrojstva/ (обложка) | Монтажник вводит кабель в трубу через воронку в колодце |
| 3 | верх-право | `roller-entry-2` | — (резерв) | Входная воронка и ролик для затягивания кабеля в трубу |
| 4 | низ-лево | `roller-entry-bell` | — (резерв) | Раструб на входе кабеля в гофрированную трубу |
| 5 | низ-центр | `roller-corner-manhole` | — (резерв) | Установка роликового устройства на колодец |
| 6 | низ-право | `roller-entry-set` | — (резерв) | Комплект воронок и роликов для протяжки кабеля |

## Полотно 12 — УЗК

Файл: `canvases/canvas-12.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Устройство закладки кабеля на катушке у колодца
Photo 2 (top-center): Проталкивание стеклопластикового прутка в трубу
Photo 3 (top-right): Наконечник с проушиной на прутке УЗК
Photo 4 (bottom-left): Работа с УЗК в кабельном помещении
Photo 5 (bottom-center): Перемещение УЗК на колёсах по площадке
Photo 6 (bottom-right): Набор наконечников, щёток и чулков для УЗК

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `uzk-1` | /oborudovanie/uzk/ (обложка) | Устройство закладки кабеля на катушке у колодца |
| 2 | верх-центр | `uzk-2` | — (резерв) | Проталкивание стеклопластикового прутка в трубу |
| 3 | верх-право | `uzk-3` | — (резерв) | Наконечник с проушиной на прутке УЗК |
| 4 | низ-лево | `uzk-4` | — (резерв) | Работа с УЗК в кабельном помещении |
| 5 | низ-центр | `uzk-5` | — (резерв) | Перемещение УЗК на колёсах по площадке |
| 6 | низ-право | `uzk-6` | — (резерв) | Набор наконечников, щёток и чулков для УЗК |

## Полотно 13 — Кабельные толкатели

Файл: `canvases/canvas-13.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Гусеничный кабельный толкатель в траншее
Photo 2 (top-center): Гусеницы толкателя, обжимающие кабель
Photo 3 (top-right): Несколько толкателей вдоль трассы кабельной линии
Photo 4 (bottom-left): Роликовый кабельный толкатель с электроприводом
Photo 5 (bottom-center): Подключение кабельного толкателя
Photo 6 (bottom-right): Кабельный толкатель в тоннеле

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `pusher-1` | /oborudovanie/kabelnye-tolkateli/ (обложка) | Гусеничный кабельный толкатель в траншее |
| 2 | верх-центр | `pusher-3` | — (резерв) | Гусеницы толкателя, обжимающие кабель |
| 3 | верх-право | `pusher-2` | — (резерв) | Несколько толкателей вдоль трассы кабельной линии |
| 4 | низ-лево | `pusher-4` | — (резерв) | Роликовый кабельный толкатель с электроприводом |
| 5 | низ-центр | `pusher-5` | — (резерв) | Подключение кабельного толкателя |
| 6 | низ-право | `tech-tunnel` | /tekhnologii/kollektory-i-tonneli/ (обложка) | Кабельный толкатель в тоннеле |

## Полотно 14 — Трубы и кабельная канализация

Файл: `canvases/canvas-14.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Укладка защитных труб в траншею
Photo 2 (top-center): Тяговый наконечник в трубе
Photo 3 (top-right): Прочистка трубы щёткой перед протяжкой
Photo 4 (bottom-left): Герметичные вводы труб в стене
Photo 5 (bottom-center): Прицеп с барабаном полиэтиленовой трубы
Photo 6 (bottom-right): Блок кабельной канализации из труб

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-duct` | /tekhnologii/v-trubah/ (обложка) | Укладка защитных труб в траншею |
| 2 | верх-центр | `tech-duct-3` | — (резерв) | Тяговый наконечник в трубе |
| 3 | верх-право | `tech-duct-clean` | — (резерв) | Прочистка трубы щёткой перед протяжкой |
| 4 | низ-лево | `tech-duct-2` | — (резерв) | Герметичные вводы труб в стене |
| 5 | низ-центр | `tech-duct-reel` | — (резерв) | Прицеп с барабаном полиэтиленовой трубы |
| 6 | низ-право | `tech-duct-block` | — (резерв) | Блок кабельной канализации из труб |

## Полотно 15 — Аренда и техника на прицепах

Файл: `canvases/canvas-15.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Передвижная электростанция с осветительной мачтой на объекте
Photo 2 (top-center): Сцепное устройство и опоры прицепа
Photo 3 (top-right): Ночная прокладка кабеля с освещением
Photo 4 (bottom-left): Кабельная лебедка на прицепе в сервисном цеху
Photo 5 (bottom-center): Проверка прицепа-барабановоза перед выдачей
Photo 6 (bottom-right): Парк оборудования для аренды

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `gen-1` | — (резерв) | Передвижная электростанция с осветительной мачтой на объекте |
| 2 | верх-центр | `trailer-hitch` | — (резерв) | Сцепное устройство и опоры прицепа |
| 3 | верх-право | `tech-night` | — (резерв) | Ночная прокладка кабеля с освещением |
| 4 | низ-лево | `rent-winch` | /arenda/lebedki/ (обложка) | Кабельная лебедка на прицепе в сервисном цеху |
| 5 | низ-центр | `rent-trailer` | /arenda/pricepy/ (обложка) | Проверка прицепа-барабановоза перед выдачей |
| 6 | низ-право | `rent-hub` | /arenda/ (обложка) | Парк оборудования для аренды |

## Полотно 16 — Траншея и зимняя прокладка

Файл: `canvases/canvas-16.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Разработка траншеи под кабельную линию
Photo 2 (top-center): Раскатка кабеля по роликам в траншее
Photo 3 (top-right): Защитные плиты и сигнальная сетка над кабелем
Photo 4 (bottom-left): Прогрев кабельного барабана в тепляке зимой
Photo 5 (bottom-center): Тепловая пушка прогревает кабель на барабане
Photo 6 (bottom-right): Уплотнение грунта при обратной засыпке траншеи

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-trench` | /tekhnologii/v-transhee/ (обложка) | Разработка траншеи под кабельную линию |
| 2 | верх-центр | `tech-trench-rollers` | /tekhnologii/v-transhee/raskatka-po-rolikam/ (обложка) | Раскатка кабеля по роликам в траншее |
| 3 | верх-право | `tech-trench-backfill` | /tekhnologii/v-transhee/zashchita-i-zasypka/ (обложка) | Защитные плиты и сигнальная сетка над кабелем |
| 4 | низ-лево | `tech-winter` | /tekhnologii/zimnyaya-prokladka/ (обложка) | Прогрев кабельного барабана в тепляке зимой |
| 5 | низ-центр | `tech-winter-2` | — (резерв) | Тепловая пушка прогревает кабель на барабане |
| 6 | низ-право | `tech-trench-backfill-2` | — (резерв) | Уплотнение грунта при обратной засыпке траншеи |

## Полотно 17 — Протяжка в трубах и контроль

Файл: `canvases/canvas-17.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Смазка кабеля при затягивании в трубу
Photo 2 (top-center): Кабельная камера с роликами и вводами труб
Photo 3 (top-right): Инженер анализирует график тяжения на ноутбуке
Photo 4 (bottom-left): Тяговая головка на кабеле
Photo 5 (bottom-center): График тяжения кабеля на планшете
Photo 6 (bottom-right): Ввод высоковольтного кабеля в трубу через роликовое устройство

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-duct-winch` | /tekhnologii/v-trubah/zatyagivanie-lebedkoj/ (обложка) | Смазка кабеля при затягивании в трубу |
| 2 | верх-центр | `tech-duct-chamber` | — (резерв) | Кабельная камера с роликами и вводами труб |
| 3 | верх-право | `tech-calc` | /tekhnologii/raschet-tyazheniya/ (обложка) | Инженер анализирует график тяжения на ноутбуке |
| 4 | низ-лево | `rigging-head` | — (резерв) | Тяговая головка на кабеле |
| 5 | низ-центр | `gauge-1` | /oborudovanie/kontrol-tyazheniya/ (обложка) | График тяжения кабеля на планшете |
| 6 | низ-право | `tech-hv` | /tekhnologii/vysokovoltnye-kabeli/ (обложка) | Ввод высоковольтного кабеля в трубу через роликовое устройство |

## Полотно 18 — ГНБ, ВОЛС, эстакады, тоннели

Файл: `canvases/canvas-18.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Установка горизонтально-направленного бурения
Photo 2 (top-center): Затягивание трубы в скважину ГНБ
Photo 3 (top-right): Задувка кабеля в микротрубки
Photo 4 (bottom-left): Протяжка кабеля в колодец с прицепа-барабановоза
Photo 5 (bottom-center): Прокладка кабеля по эстакаде на промышленном объекте
Photo 6 (bottom-right): Кабели на конструкциях в кабельном тоннеле

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-hdd` | /tekhnologii/gnb/ (обложка) | Установка горизонтально-направленного бурения |
| 2 | верх-центр | `tech-hdd-2` | — (резерв) | Затягивание трубы в скважину ГНБ |
| 3 | верх-право | `tech-blowing` | /tekhnologii/vols/pnevmoprokladka/ (обложка) | Задувка кабеля в микротрубки |
| 4 | низ-лево | `tech-fiber` | /tekhnologii/vols/ (обложка) | Протяжка кабеля в колодец с прицепа-барабановоза |
| 5 | низ-центр | `tech-tray` | /tekhnologii/estakady-i-lotki/ (обложка) | Прокладка кабеля по эстакаде на промышленном объекте |
| 6 | низ-право | `tech-tunnel-2` | — (резерв) | Кабели на конструкциях в кабельном тоннеле |

## Полотно 19 — Сервис и офис

Файл: `canvases/canvas-19.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Ремонт двигателя кабельной лебедки
Photo 2 (top-center): Склад запасных частей
Photo 3 (top-right): Выездная сервисная служба у лебедки на объекте
Photo 4 (bottom-left): Детали тормоза и ступицы прицепа при ремонте
Photo 5 (bottom-center): Офис компании
Photo 6 (bottom-right): Шоурум с кабельной лебедкой

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `service-repair-engine` | — (резерв) | Ремонт двигателя кабельной лебедки |
| 2 | верх-центр | `service-parts` | — (резерв) | Склад запасных частей |
| 3 | верх-право | `service-hub-2` | — (резерв) | Выездная сервисная служба у лебедки на объекте |
| 4 | низ-лево | `service-brakes` | — (резерв) | Детали тормоза и ступицы прицепа при ремонте |
| 5 | низ-центр | `about-office` | — (резерв) | Офис компании |
| 6 | низ-право | `about-showroom` | — (резерв) | Шоурум с кабельной лебедкой |

## Полотно 20 — Компания и филиалы

Файл: `canvases/canvas-20.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Бизнес-центр, в котором расположен офис
Photo 2 (top-center): Консультация клиентов в шоуруме оборудования
Photo 3 (top-right): Команда инженеров компании
Photo 4 (bottom-left): Складской комплекс филиала
Photo 5 (bottom-center): Стеллажи с кабельными роликами на складе
Photo 6 (bottom-right): Парк кабельных прицепов и лебедок у склада филиала

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `contacts-office` | /kontakty/ и страницы городов | Бизнес-центр, в котором расположен офис |
| 2 | верх-центр | `about-consult` | — (резерв) | Консультация клиентов в шоуруме оборудования |
| 3 | верх-право | `about-1` | /o-kompanii/ (обложка) | Команда инженеров компании |
| 4 | низ-лево | `contacts-warehouse` | страницы городов | Складской комплекс филиала |
| 5 | низ-центр | `about-2b` | — (резерв) | Стеллажи с кабельными роликами на складе |
| 6 | низ-право | `about-fleet` | — (резерв) | Парк кабельных прицепов и лебедок у склада филиала |

---

Всего слотов: 120. Без привязки к странице (резерв): 58. Слотов на сайте без промпта: 0.
