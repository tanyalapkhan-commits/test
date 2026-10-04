# Фото для сайта: 20 полотен × 6 фото = 120 изображений

Как пользоваться:

1. Скопируйте промпт полотна в ChatGPT (генерация изображений) или другой генератор. Просите максимальное разрешение, затем при необходимости увеличьте до 8K (7680×4320) апскейлером.
2. Сохраните результат как `canvases/canvas-01.png` … `canvases/canvas-20.png` (номер = номер полотна).
3. Запустите `python3 tools/slice_canvases.py` — скрипт разрежет каждое полотно на 6 фото, назовёт их по слотам и сохранит в `wp-content/themes/kabelpro/assets/img/photos/` в формате WebP.
4. Загрузите папку темы на хостинг — фото сразу появятся на нужных страницах (alt-тексты подставятся автоматически).

Если генератор нарисовал на полотне надписи или логотипы — перегенерируйте полотно: текст на фото портит впечатление и мешает SEO.

Отдельное фото можно заменить вручную: положите файл `<слот>.jpg` или `<слот>.webp` в `wp-content/uploads/kp-photos/` (переживёт обновление темы) или в папку `assets/img/photos/` темы.

---

## Полотно 01 — Главная страница и компания

Файл: `canvases/canvas-01.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Wide cinematic shot of a cable laying site at golden hour: a long open trench with yellow cable rollers, a large wooden cable drum on a navy trailer in the foreground, black power cable running along the rollers into the distance, a capstan winch far away, two workers walking along the trench, city skyline in soft haze.
Photo 2 (top-center): Three-quarter view of a heavy diesel capstan cable pulling winch mounted on a two-axle navy trailer, two grooved yellow capstan drums, large rope storage reel with synthetic orange rope, control panel with digital display, parked on gravel at a substation construction site.
Photo 3 (top-right): Equipment rental yard: a row of navy cable winches and cable drum trailers neatly parked on clean asphalt in front of a modern warehouse, a manager in navy jacket handing documents to a contractor, pickup truck with hitch nearby.
Photo 4 (bottom-left): Service engineer in navy overalls inspecting the hydraulic pump of a cable winch inside a bright clean workshop, open engine cover, tools on a trolley, diagnostic tablet in hand.
Photo 5 (bottom-center): Instructor explaining the control panel of a cable winch to a group of five workers in hard hats outdoors at a training ground, one worker holding a radio, cable drum in background.
Photo 6 (bottom-right): Group of six engineers and technicians standing confidently in front of a cable pulling winch and a large cable drum at a construction site, natural poses, friendly, Eastern European appearance, daytime.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `home-hero` | / (обложка), / (шаблон главной) | Протяжка силового кабеля кабельной лебедкой на строительной площадке |
| 2 | верх-центр | `home-winch-diesel` | / (шаблон главной) | Дизельная кабельная лебедка на прицепе с барабаном троса |
| 3 | верх-право | `home-rent` | / (шаблон главной) | Аренда кабельной лебедки и прицепа для барабана |
| 4 | низ-лево | `home-service` | / (шаблон главной) | Сервисный инженер обслуживает кабельную лебедку |
| 5 | низ-центр | `home-training` | / (шаблон главной) | Обучение монтажной бригады работе с лебедкой |
| 6 | низ-право | `about-1` | /o-kompanii/ (обложка) | Команда инженеров компании на объекте прокладки кабеля |

## Полотно 02 — Кабельные лебедки: обзор

Файл: `canvases/canvas-02.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Lineup of four cable pulling winches of different sizes (small portable petrol, mid-size skid-mounted, diesel on trailer, electric) on a clean concrete yard, side by side, overcast daylight.
Photo 2 (top-center): Operator standing at a capstan cable winch watching a digital tension display, rope running from the winch towards a trench with rollers, black power cable approaching, construction site with fences.
Photo 3 (top-right): Top-down flat-lay on concrete of a complete cable pulling kit: coiled synthetic rope, a swivel, a woven steel cable pulling sock, a digital tension recorder, three yellow cable rollers, gloves, radio, arranged neatly.
Photo 4 (bottom-left): Close-up of a twin capstan pulling mechanism: two grooved yellow capstan drums with synthetic rope wound in figure-eight, hydraulic motor visible, shallow depth of field.
Photo 5 (bottom-center): Close-up of a drum-type winch with steel wire rope wound in several neat layers on a large drum, level wind guide, industrial lighting.
Photo 6 (bottom-right): Electric cable pulling winch placed in a concrete underground cable tunnel with cable brackets on walls, LED lighting, power cable connection to the winch, worker with tablet.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-hub` | /oborudovanie/kabelnye-lebedki/ (обложка) | Кабельные лебедки разных типов на площадке |
| 2 | верх-центр | `winch-hub-field` | /oborudovanie/kabelnye-lebedki/ | Протяжка силового кабеля капстанной лебедкой с контролем усилия по дисплею |
| 3 | верх-право | `winch-hub-set` | /oborudovanie/kabelnye-lebedki/ | Комплект для протяжки: лебедка, трос, регистратор, вертлюг, чулок, ролики |
| 4 | низ-лево | `winch-capstan` | /oborudovanie/kabelnye-lebedki/kapstannye-i-barabannye/ (обложка) | Двухшкивный капстанный механизм кабельной лебедки |
| 5 | низ-центр | `winch-capstan-2` | /oborudovanie/kabelnye-lebedki/kapstannye-i-barabannye/ | Барабанная лебедка с многослойной намоткой стального каната |
| 6 | низ-право | `winch-electric` | /oborudovanie/kabelnye-lebedki/elektricheskie/ (обложка) | Электрическая кабельная лебедка в кабельном коллекторе |

## Полотно 03 — Бензиновые лебедки

Файл: `canvases/canvas-03.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Compact petrol-powered capstan cable winch on a tubular frame placed next to a cable manhole in a city courtyard, rope going into the manhole, Soviet-era apartment blocks behind.
Photo 2 (top-center): Studio-like outdoor product shot of a mid-size petrol cable winch on skids: air-cooled engine, hydraulic pump, twin capstans, rope storage reel with level wind, control lever and display.
Photo 3 (top-right): Workers pulling a medium-voltage cable into an orange HDPE duct at an open pit, petrol winch at the other end, a worker guiding the cable with a bellmouth entry device, mud and gravel realistic.
Photo 4 (bottom-left): Two workers carrying a light portable petrol capstan winch by its handles across a lawn towards a trench, coiled rope on top.
Photo 5 (bottom-center): Petrol cable winch of 3 tons capacity mounted on a single-axle light trailer hitched to a pickup truck, rural road with birch trees.
Photo 6 (bottom-right): Small petrol capstan winch pulling a thin black fiber optic cable from a manhole of a telecom duct network on a city sidewalk, orange fiber cable drum on a stand nearby, technician with tension meter.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-petrol-1` | /oborudovanie/kabelnye-lebedki/benzinovye/ (обложка) | Бензиновая кабельная лебедка на объекте |
| 2 | верх-центр | `winch-petrol-2` | /oborudovanie/kabelnye-lebedki/benzinovye/ | Бензиновая капстанная лебедка с гидростатическим приводом и накопительным барабаном |
| 3 | верх-право | `winch-petrol-3` | /oborudovanie/kabelnye-lebedki/benzinovye/ | Затягивание кабеля 10 кВ в полиэтиленовую трубу бензиновой лебедкой у колодца |
| 4 | низ-лево | `winch-petrol-small` | /oborudovanie/kabelnye-lebedki/benzinovye/do-1-tonny/ (обложка) | Лёгкая переносная бензиновая лебедка до 1 тонны |
| 5 | низ-центр | `winch-petrol-3t` | /oborudovanie/kabelnye-lebedki/benzinovye/1-3-tonny/ (обложка) | Бензиновая кабельная лебедка 3 тонны на одноосном прицепе |
| 6 | низ-право | `winch-petrol-fiber` | /oborudovanie/kabelnye-lebedki/benzinovye/dlya-vols/ (обложка) | Протяжка оптического кабеля бензиновой лебедкой малой мощности |

## Полотно 04 — Дизельные лебедки

Файл: `canvases/canvas-04.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Large diesel cable pulling winch with soundproof canopy on trailer at a high-voltage cable route, outriggers deployed, anchored to concrete blocks, cloudy sky.
Photo 2 (top-center): Detailed three-quarter view of diesel winch on two-axle trailer showing twin capstans, rope storage drum with synthetic rope, operator control panel with screen, hydraulic hoses neatly routed.
Photo 3 (top-right): High-voltage cable pull in progress: huge steel cable drum lifted on hydraulic jacks, thick black 110 kV cable entering a duct, workers communicating by radio, winch visible far away along the route.
Photo 4 (bottom-left): Mid-size 5-ton diesel cable winch on a single-axle trailer in an urban street work zone with barriers, rope extending into a cable manhole.
Photo 5 (bottom-center): 10-ton diesel capstan winch positioned at the exit of an HDD crossing near a river bank, rope going into a large HDPE pipe, drilling rig visible on the opposite bank.
Photo 6 (bottom-right): Very large heavy-duty diesel cable pulling winch on a tandem trailer at the portal of a cable tunnel, massive capstans, large rope drum, crew of engineers next to it for scale.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-diesel-1` | /oborudovanie/kabelnye-lebedki/dizelnye/ (обложка) | Дизельная кабельная лебедка для прокладки высоковольтного кабеля |
| 2 | верх-центр | `winch-diesel-2` | /oborudovanie/kabelnye-lebedki/dizelnye/ | Дизельная капстанная лебедка на двухосном прицепе: шкивы, барабан, пульт |
| 3 | верх-право | `winch-diesel-3` | /oborudovanie/kabelnye-lebedki/dizelnye/ | Протяжка кабеля 110 кВ: лебедка, регистратор и барабан на гидравлических домкратах |
| 4 | низ-лево | `winch-diesel-5t` | /oborudovanie/kabelnye-lebedki/dizelnye/3-5-tonn/ (обложка) | Дизельная лебедка 5 тонн для кабелей 35–110 кВ |
| 5 | низ-центр | `winch-diesel-10t` | /oborudovanie/kabelnye-lebedki/dizelnye/5-10-tonn/ (обложка) | Дизельная кабельная лебедка 10 тонн на объекте |
| 6 | низ-право | `winch-diesel-20t` | /oborudovanie/kabelnye-lebedki/dizelnye/10-20-tonn/ (обложка) | Тяжёлая дизельная лебедка 20 тонн для кабелей 220–500 кВ |

## Полотно 05 — Лебедки на прицепе, электрические, гидравлические

Файл: `canvases/canvas-05.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Diesel cable winch on road-legal trailer being towed by a navy truck on a highway, transport position, lights and fenders visible.
Photo 2 (top-center): Close view of trailer-mounted winch with deployed stabilizer legs and front anchor blade dug into the ground, chain anchoring to ground anchors.
Photo 3 (top-right): Close-up of an electric winch control cabinet with frequency drive, emergency stop button, digital force display, cable glands, inside a tunnel.
Photo 4 (bottom-left): Hydraulic cable winch mounted on a frame connected by hydraulic hoses to an excavator auxiliary line, excavator parked beside a trench.
Photo 5 (bottom-center): Compact hydraulic winch with separate portable hydraulic power pack connected by hoses on a construction site, worker connecting quick couplings.
Photo 6 (bottom-right): Long concrete cable tunnel with cable rollers fixed to brackets, power cable being pulled along, electric winch at tunnel end, perspective vanishing point, LED lights.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-diesel-trailer` | /oborudovanie/kabelnye-lebedki/dizelnye/na-pricepe/ (обложка) | Дизельная кабельная лебедка на прицепе в транспортном положении |
| 2 | верх-центр | `winch-diesel-trailer-2` | /oborudovanie/kabelnye-lebedki/dizelnye/na-pricepe/ | Лебедка на прицепе с выставленными опорами и анкеровкой |
| 3 | верх-право | `winch-electric-2` | /oborudovanie/kabelnye-lebedki/elektricheskie/ | Пульт частотного управления электрической лебедки |
| 4 | низ-лево | `winch-hydraulic` | /oborudovanie/kabelnye-lebedki/gidravlicheskie/ (обложка) | Гидравлическая кабельная лебедка, подключённая к экскаватору |
| 5 | низ-центр | `winch-hydraulic-2` | /oborudovanie/kabelnye-lebedki/gidravlicheskie/ | Гидравлическая лебедка с отдельной гидростанцией |
| 6 | низ-право | `winch-electric-tunnel` | /oborudovanie/kabelnye-lebedki/elektricheskie/ | Протяжка кабеля электрической лебедкой в тоннеле |

## Полотно 06 — Прицепы для кабельных барабанов

Файл: `canvases/canvas-06.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Three cable drum trailers of different sizes parked in a row, each carrying a wooden cable drum, warehouse yard.
Photo 2 (top-center): Road cable drum trailer with a large wooden drum of black cable towed by a truck along a suburban road.
Photo 3 (top-right): Hydraulic self-loading cable drum trailer lifting a large drum from the ground with hydraulic arms, operator using a remote control.
Photo 4 (bottom-left): Multi-drum trailer carrying three medium cable drums side by side, three cables being paid out simultaneously into a trench.
Photo 5 (bottom-center): Cable being unreeled directly from a drum trailer at the start of a trench, worker braking the drum, rollers leading into trench.
Photo 6 (bottom-right): Close-up of hydraulic drum drive motor and brake on a cable trailer axle, drum flange with bolts.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `trailer-hub` | /oborudovanie/kabelnye-pricepy/ (обложка) | Прицепы для кабельных барабанов разной грузоподъёмности |
| 2 | верх-центр | `trailer-road` | /oborudovanie/kabelnye-pricepy/dorozhnye/ (обложка), /oborudovanie/kabelnye-pricepy/dorozhnye/ | Дорожный прицеп-барабановоз с кабельным барабаном |
| 3 | верх-право | `trailer-hydraulic` | /oborudovanie/kabelnye-pricepy/gidravlicheskie/ (обложка) | Гидравлический кабельный прицеп с самопогрузкой барабана |
| 4 | низ-лево | `trailer-multi` | /oborudovanie/kabelnye-pricepy/mnogobarabannye/ (обложка) | Многобарабанный прицеп для одновременной раскатки трёх фаз |
| 5 | низ-центр | `trailer-road-2` | /oborudovanie/kabelnye-pricepy/ | Раскатка кабеля непосредственно с прицепа-барабановоза |
| 6 | низ-право | `trailer-hydraulic-2` | /oborudovanie/kabelnye-pricepy/gidravlicheskie/ | Гидравлический привод вращения барабана на прицепе |

## Полотно 07 — Домкраты и раскаточные устройства

Файл: `canvases/canvas-07.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Pair of cable drum jacks holding a large wooden drum on a steel axle at a trench start, cable unrolling from the top of the drum.
Photo 2 (top-center): Mechanical screw-type cable drum jack stands with a steel axle shaft, close view of screw and handle, on wooden boards.
Photo 3 (top-right): Heavy-duty hydraulic drum jacks lifting a massive steel cable drum for 110 kV cable, hydraulic hand pump and hose, workers at safe distance.
Photo 4 (bottom-left): Ground-level drum unwinding platform (turntable rollers) supporting a cable drum, braking device visible, cable feeding into a duct.
Photo 5 (bottom-center): Two workers inserting a steel axle through the center hole of a wooden cable drum before lifting it on jacks.
Photo 6 (bottom-right): Close-up of disc brake and hydraulic motor attached to a drum stand supporting a large drum, industrial detail shot.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `jack-hub` | /oborudovanie/domkraty-i-raskatchiki/ (обложка) | Домкраты для кабельных барабанов на объекте |
| 2 | верх-центр | `jack-mech` | /oborudovanie/domkraty-i-raskatchiki/mekhanicheskie-domkraty/ (обложка) | Механические винтовые домкраты для кабельного барабана |
| 3 | верх-право | `jack-hydraulic` | /oborudovanie/domkraty-i-raskatchiki/gidravlicheskie-domkraty/ (обложка) | Гидравлические домкраты для тяжёлого кабельного барабана |
| 4 | низ-лево | `jack-platform` | /oborudovanie/domkraty-i-raskatchiki/raskatochnye-ustrojstva/ (обложка) | Раскаточная платформа с тормозом для кабельного барабана |
| 5 | низ-центр | `jack-mech-2` | — (резерв) | Установка оси в кабельный барабан |
| 6 | низ-право | `jack-hydraulic-2` | — (резерв) | Тормоз и привод на гидравлических стойках для барабана |

## Полотно 08 — Кабельные ролики

Файл: `canvases/canvas-08.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Assortment of cable rollers on a workshop floor: straight trench rollers, corner rollers, bellmouth duct entry roller, all yellow with steel frames.
Photo 2 (top-center): Row of straight yellow cable rollers placed at regular intervals along the bottom of a sandy trench, receding into distance, cable lying on them.
Photo 3 (top-right): Corner cable roller assembly with multiple vertical rollers forming a curve at a trench bend, black cable passing around it.
Photo 4 (bottom-left): Duct entry guide with rollers attached to the mouth of an orange plastic pipe in a pit, cable entering smoothly.
Photo 5 (bottom-center): Close-up of a wide heavy-duty straight roller with polyamide roll supporting a thick high-voltage cable.
Photo 6 (bottom-right): Corner rollers mounted inside a concrete cable manhole guiding a cable at a 90 degree turn between two ducts.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `roller-hub` | /oborudovanie/kabelnye-roliki/ (обложка) | Кабельные ролики разных типов |
| 2 | верх-центр | `roller-straight` | /oborudovanie/kabelnye-roliki/linejnye/ (обложка) | Линейные кабельные ролики в траншее |
| 3 | верх-право | `roller-corner` | /oborudovanie/kabelnye-roliki/uglovye/ (обложка) | Угловой кабельный ролик на повороте траншеи |
| 4 | низ-лево | `roller-entry` | /oborudovanie/kabelnye-roliki/vhodnye-ustrojstva/ (обложка) | Входное устройство с роликами для затягивания кабеля в трубу |
| 5 | низ-центр | `roller-straight-2` | — (резерв) | Широкий ролик для кабеля большого диаметра |
| 6 | низ-право | `roller-corner-2` | — (резерв) | Угловые ролики в кабельном колодце |

## Полотно 09 — Толкатели, УЗК, каталог

Файл: `canvases/canvas-09.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Showroom-like warehouse display of cable laying equipment: winch, drum trailer, rollers, duct rodder on reel, jacks, arranged neatly under bright lights.
Photo 2 (top-center): Caterpillar-type cable pusher machine with rubber tracks gripping a thick black cable in a trench, power cable from control unit.
Photo 3 (top-right): Several cable pushers placed along a long trench route, connected by control cables, engineer with remote control unit.
Photo 4 (bottom-left): Duct rodder: fiberglass rod wound on a steel cage reel on wheels, next to an open telecom manhole.
Photo 5 (bottom-center): Technician pushing a yellow fiberglass duct rod into a duct inside a manhole, reel beside him on the sidewalk.
Photo 6 (bottom-right): Split plastic bellmouth funnel installed at the end of a duct, cable entering, close-up with mud and water realistic.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `eq-hub` | /oborudovanie/ (обложка) | Оборудование для прокладки кабеля: лебедка, прицеп, ролики, УЗК |
| 2 | верх-центр | `pusher-1` | /oborudovanie/kabelnye-tolkateli/ (обложка) | Кабельный толкатель на трассе прокладки |
| 3 | верх-право | `pusher-2` | — (резерв) | Система синхронизированных кабельных толкателей |
| 4 | низ-лево | `uzk-1` | /oborudovanie/uzk/ (обложка) | Устройство закладки кабеля на катушке |
| 5 | низ-центр | `uzk-2` | — (резерв) | Проталкивание стеклопластикового прутка в канал кабельной канализации |
| 6 | низ-право | `roller-entry-2` | — (резерв) | Защитная воронка на входе кабеля в трубу |

## Полотно 10 — Оснастка, инструмент, контроль тяжения

Файл: `canvases/canvas-10.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Selection of woven steel cable pulling socks, swivels with shackles and pulling eyes laid out on a wooden workbench.
Photo 2 (top-center): Close-up of a steel pulling sock fitted onto the end of a power cable, taped, connected via a swivel to a synthetic rope.
Photo 3 (top-right): Professional cable tools: ratchet cable cutter, hydraulic crimping tool, cable stripping tool and sheath cutter in an open case.
Photo 4 (bottom-left): Worker cutting a thick power cable with a hydraulic cable cutter on site, gloves and safety glasses.
Photo 5 (bottom-center): Digital load cell dynamometer with display connected inline with a pulling rope, readings visible as abstract digits without text.
Photo 6 (bottom-right): Operator hand next to a rugged tablet showing a tension graph line on the winch control panel, printed paper strip with graph.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `rigging-1` | /oborudovanie/osnastka/ (обложка) | Кабельные чулки, вертлюги и тяговые головки |
| 2 | верх-центр | `rigging-2` | — (резерв) | Тяговый чулок на кабеле с вертлюгом |
| 3 | верх-право | `tools-1` | /oborudovanie/instrument/ (обложка) | Инструмент для монтажа кабеля |
| 4 | низ-лево | `tools-2` | — (резерв) | Резка силового кабеля гидравлическим кабелерезом |
| 5 | низ-центр | `gauge-1` | /oborudovanie/kontrol-tyazheniya/ (обложка) | Электронный динамометр и регистратор тяжения кабеля |
| 6 | низ-право | `gauge-2` | — (резерв) | Регистратор тяжения на пульте лебедки и протокол протяжки |

## Полотно 11 — Технологии: прокладка в траншее

Файл: `canvases/canvas-11.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Aerial drone view of a cable route construction: open trench, cable drum trailer, winch, rollers, workers, alongside a road in a suburban area.
Photo 2 (top-center): Open trench with sand bedding, three single-core power cables laid in trefoil, workers checking spacing, measuring tape.
Photo 3 (top-right): Cable being pulled along rollers in a trench, viewed along the trench axis, worker observer with radio at a bend.
Photo 4 (bottom-left): Worker laying red protective plastic plates over cables on sand bed in trench, warning tape roll, small excavator ready for backfill.
Photo 5 (bottom-center): Excavator digging a straight trench for a cable line along a field edge, spoil heap on one side, surveyor with GPS rod.
Photo 6 (bottom-right): Yellow warning tape laid along a partially backfilled cable trench, compaction plate machine in use.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-hub` | /tekhnologii/ (обложка) | Технологии прокладки кабеля |
| 2 | верх-центр | `tech-trench` | /tekhnologii/v-transhee/ (обложка) | Прокладка кабеля в траншее |
| 3 | верх-право | `tech-trench-rollers` | /tekhnologii/v-transhee/raskatka-po-rolikam/ (обложка) | Раскатка кабеля по роликам в траншее |
| 4 | низ-лево | `tech-trench-backfill` | /tekhnologii/v-transhee/zashchita-i-zasypka/ (обложка) | Защита кабеля в траншее и обратная засыпка |
| 5 | низ-центр | `tech-trench-2` | — (резерв) | Разработка траншеи под кабельную линию экскаватором |
| 6 | низ-право | `tech-trench-backfill-2` | — (резерв) | Сигнальная лента над кабелем в траншее |

## Полотно 12 — Технологии: трубы, канализация, ГНБ

Файл: `canvases/canvas-12.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Bundle of orange and black HDPE ducts laid in a trench with spacers, ready for cable installation, urban street.
Photo 2 (top-center): Winch rope emerging from a duct at a pit, worker applying cable pulling lubricant to the cable entering the duct at the other end.
Photo 3 (top-right): Horizontal directional drilling rig on tracks at a road crossing, drill rods, bentonite mixing unit, operators.
Photo 4 (bottom-left): Long welded black HDPE pipe string being pulled back into an HDD borehole, reamer and swivel visible at entry pit.
Photo 5 (bottom-center): Open concrete cable manhole with multiple duct openings on the walls, ladder, lighting, one duct with cable inserted.
Photo 6 (bottom-right): Close-up of gloved hands applying white cable pulling lubricant gel on a black cable at a duct mouth.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-duct` | /tekhnologii/v-trubah/ (обложка) | Прокладка кабеля в трубах кабельной канализации |
| 2 | верх-центр | `tech-duct-winch` | /tekhnologii/v-trubah/zatyagivanie-lebedkoj/ (обложка) | Затягивание кабеля в трубы лебедкой |
| 3 | верх-право | `tech-hdd` | /tekhnologii/gnb/ (обложка) | Горизонтально-направленное бурение под кабельный переход |
| 4 | низ-лево | `tech-hdd-2` | — (резерв) | Затягивание трубы в скважину ГНБ |
| 5 | низ-центр | `tech-duct-2` | — (резерв) | Кабельный колодец с выходами труб |
| 6 | низ-право | `tech-duct-winch-2` | — (резерв) | Нанесение смазки на кабель при затягивании в трубу |

## Полотно 13 — Технологии: ВОЛС и высоковольтные кабели

Файл: `canvases/canvas-13.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Fiber optic cable installation crew at a telecom manhole on a city street, small cable drum on stand, thin black cable going into microducts.
Photo 2 (top-center): Cable blowing machine connected to a microduct with an air compressor nearby, technician monitoring speed and pressure.
Photo 3 (top-right): Massive steel drum with thick 220 kV cable at the beginning of a route, crane nearby, engineers in hard hats inspecting the cable end cap.
Photo 4 (bottom-left): Three very thick high-voltage cables laid in trefoil formation with cable cleats on a concrete bed in a deep trench.
Photo 5 (bottom-center): Close-up of a bundle of colorful microducts in a protective sheath at an open trench.
Photo 6 (bottom-right): Mobile air compressor on trailer next to a van, hoses connected to a blowing machine at roadside, rural landscape.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-fiber` | /tekhnologii/vols/ (обложка) | Прокладка оптического кабеля связи |
| 2 | верх-центр | `tech-blowing` | /tekhnologii/vols/pnevmoprokladka/ (обложка) | Пневмопрокладка оптического кабеля машиной для задувки |
| 3 | верх-право | `tech-hv` | /tekhnologii/vysokovoltnye-kabeli/ (обложка) | Прокладка кабеля 110–500 кВ |
| 4 | низ-лево | `tech-hv-2` | — (резерв) | Высоковольтные кабели, уложенные треугольником в траншее |
| 5 | низ-центр | `tech-fiber-2` | — (резерв) | Микротрубки для оптического кабеля |
| 6 | низ-право | `tech-blowing-2` | — (резерв) | Компрессор и машина для задувки на трассе ВОЛС |

## Полотно 14 — Технологии: коллекторы, эстакады, зима

Файл: `canvases/canvas-14.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Underground cable collector with steel brackets on both walls carrying multiple power cables, workers pulling a new cable on rollers.
Photo 2 (top-center): Industrial cable rack (overhead trestle) with wide cable trays filled with cables at a refinery, workers on scissor lift.
Photo 3 (top-right): Winter cable laying: snow-covered site, cable drum covered with insulated heating tent, workers in winter gear, frosty air.
Photo 4 (bottom-left): Close-up of cable rollers mounted on tunnel brackets with a cable passing over them, concrete walls, lighting.
Photo 5 (bottom-center): Tray rollers installed inside a ladder-type cable tray at a 90-degree bend, cable being pulled.
Photo 6 (bottom-right): Industrial diesel heater blowing warm air through a duct into a tent covering a cable drum, snow around, thermometer showing frost (no numbers).

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-tunnel` | /tekhnologii/kollektory-i-tonneli/ (обложка) | Прокладка кабеля в кабельном коллекторе |
| 2 | верх-центр | `tech-tray` | /tekhnologii/estakady-i-lotki/ (обложка) | Прокладка кабеля по эстакаде и в лотках |
| 3 | верх-право | `tech-winter` | /tekhnologii/zimnyaya-prokladka/ (обложка) | Прокладка кабеля при низких температурах |
| 4 | низ-лево | `tech-tunnel-2` | — (резерв) | Ролики на консолях в кабельном тоннеле |
| 5 | низ-центр | `tech-tray-2` | — (резерв) | Ролики в кабельном лотке на повороте |
| 6 | низ-право | `tech-winter-2` | — (резерв) | Прогрев кабельного барабана перед прокладкой зимой |

## Полотно 15 — Расчёт, нормативы, аренда

Файл: `canvases/canvas-15.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Engineer at a desk with laptop showing a route diagram and a graph, printed cable route drawings, calculator, office near window.
Photo 2 (top-center): Stack of technical binders and printed standards on a table at a construction site office, hard hat and reading glasses on top.
Photo 3 (top-right): Large rental fleet yard with winches, drum trailers and jacks lined up, warehouse gates in background, clean asphalt.
Photo 4 (bottom-left): Technician demonstrating a cable winch to a customer before rental handover in front of a warehouse, checklist clipboard.
Photo 5 (bottom-center): Cable drum trailer being hitched to a customer's truck at a rental depot, technician checking lights.
Photo 6 (bottom-right): Flatbed truck with crane delivering a cable winch to a construction site, unloading with straps.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `tech-calc` | /tekhnologii/raschet-tyazheniya/ (обложка) | Инженер выполняет расчёт усилия тяжения кабеля |
| 2 | верх-центр | `tech-norms` | /tekhnologii/normativy/ (обложка) | Нормативная документация по прокладке кабеля |
| 3 | верх-право | `rent-hub` | /arenda/ (обложка) | Парк оборудования для аренды |
| 4 | низ-лево | `rent-winch` | /arenda/lebedki/ (обложка) | Выдача кабельной лебедки в аренду |
| 5 | низ-центр | `rent-trailer` | /arenda/pricepy/ (обложка) | Аренда прицепа для кабельного барабана |
| 6 | низ-право | `rent-hub-2` | — (резерв) | Доставка арендованного оборудования на объект |

## Полотно 16 — Сервис и обучение

Файл: `canvases/canvas-16.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Bright modern service workshop with several cable winches on stands, mechanics working, organized tool walls.
Photo 2 (top-center): Mechanic replacing a hydraulic hose on a winch, close-up of hands with wrenches, oil tray below.
Photo 3 (top-right): Classroom training: instructor at a screen with a winch schematic, trainees in workwear taking notes.
Photo 4 (bottom-left): Test bench with reference dynamometer and hydraulic cylinder calibrating a load cell, technician recording values.
Photo 5 (bottom-center): Senior engineer standing next to the winch operator during a live cable pull, pointing at the display, construction site.
Photo 6 (bottom-right): Navy service van with open side door showing tool shelves, parked next to a cable winch at a remote site.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `service-hub` | /servis/ (обложка) | Сервисный центр по обслуживанию кабельного оборудования |
| 2 | верх-центр | `service-repair` | /servis/remont-lebedok/ (обложка) | Ремонт гидравлики кабельной лебедки |
| 3 | верх-право | `service-training` | /servis/obuchenie/ (обложка) | Обучение операторов кабельных лебедок |
| 4 | низ-лево | `service-repair-2` | — (резерв) | Калибровка датчика усилия на стенде |
| 5 | низ-центр | `service-training-2` | — (резерв) | Шеф-монтаж: инженер сопровождает первую протяжку |
| 6 | низ-право | `service-hub-2` | — (резерв) | Выездная сервисная служба |

## Полотно 17 — Отрасли: энергетика, связь, железные дороги

Файл: `canvases/canvas-17.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Collage-like single wide scene: substation in background, cable trench in foreground, fiber manhole, railway line on the side — realistic single photo composition at dusk.
Photo 2 (top-center): Electrical substation 110 kV with transformers, cable trench leading to switchgear building, cable drum in front.
Photo 3 (top-right): Telecom crew installing fiber cable along a highway, blowing equipment van, roadside cones.
Photo 4 (bottom-left): Cable laying along a railway track: cable trough with concrete covers, workers in orange vests, train passing in distance.
Photo 5 (bottom-center): Power cables entering a switchgear building through sealed wall penetrations, cable trench, technicians.
Photo 6 (bottom-right): Open telecom manhole in a city with fiber splice closure and cable loops inside, technician kneeling.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `ind-hub` | /otrasli/ (обложка) | Отрасли применения оборудования для прокладки кабеля |
| 2 | верх-центр | `ind-power` | /otrasli/energetika/ (обложка) | Прокладка кабеля на электрической подстанции |
| 3 | верх-право | `ind-telecom` | /otrasli/telekom/ (обложка) | Строительство линии связи |
| 4 | низ-лево | `ind-rail` | /otrasli/zheleznye-dorogi/ (обложка) | Прокладка кабеля вдоль железной дороги |
| 5 | низ-центр | `ind-power-2` | — (резерв) | Кабельный ввод в здание распределительного устройства |
| 6 | низ-право | `ind-telecom-2` | — (резерв) | Колодец кабельной канализации связи |

## Полотно 18 — Отрасли: нефтегаз, строительство, ВИЭ

Файл: `canvases/canvas-18.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Oil field with pumpjacks, cable trench and cable drum trailer in flat steppe landscape, workers in flame-resistant suits.
Photo 2 (top-center): Construction site of a modern residential complex, tower crane, trench for power cables to a transformer substation.
Photo 3 (top-right): Solar power plant with rows of panels, trench between rows with cables being laid, inverter station.
Photo 4 (bottom-left): Subway tunnel with cable brackets on the wall, maintenance crew installing cables at night with work lights.
Photo 5 (bottom-center): Refinery pipe and cable rack with cable trays, columns and pipelines, workers on platform.
Photo 6 (bottom-right): Wind farm with turbines on a hill, trench leading to a turbine base, cable drum trailer and winch.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `ind-oil` | /otrasli/neftegaz/ (обложка) | Прокладка кабеля на нефтегазовом месторождении |
| 2 | верх-центр | `ind-construction` | /otrasli/stroitelstvo/ (обложка) | Прокладка кабеля на строительной площадке жилого комплекса |
| 3 | верх-право | `ind-renewables` | /otrasli/vie/ (обложка) | Прокладка кабеля на солнечной электростанции |
| 4 | низ-лево | `ind-rail-2` | — (резерв) | Прокладка кабеля в тоннеле метрополитена |
| 5 | низ-центр | `ind-oil-2` | — (резерв) | Кабельная эстакада на нефтеперерабатывающем заводе |
| 6 | низ-право | `ind-renewables-2` | — (резерв) | Прокладка кабеля на ветровой электростанции |

## Полотно 19 — Компания: склад, офис, филиалы

Файл: `canvases/canvas-19.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Interior of a modern warehouse with pallet racks holding cable rollers, jacks and rope reels, forklift, winches on the floor.
Photo 2 (top-center): Engineer and client discussing cable route drawings at a meeting table in a modern office with large windows.
Photo 3 (top-right): Modern business center building exterior with glass facade on a sunny day, city street, people walking.
Photo 4 (bottom-left): Exterior of a large modern logistics warehouse complex with loading docks and trucks, clean asphalt yard.
Photo 5 (bottom-center): Package transformer substation in a new residential district, cable trench leading to it, workers laying cable.
Photo 6 (bottom-right): Winch on a test stand inside a workshop, technician testing pulling force against a load cell, protective fence.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `about-2` | — (резерв) | Склад оборудования для прокладки кабеля |
| 2 | верх-центр | `about-3` | — (резерв) | Инженер компании консультирует заказчика |
| 3 | верх-право | `contacts-office` | /kontakty/ и страницы городов | Офис компании в бизнес-центре |
| 4 | низ-лево | `contacts-warehouse` | страницы городов | Складской комплекс филиала |
| 5 | низ-центр | `ind-construction-2` | — (резерв) | Прокладка кабеля к трансформаторной подстанции нового квартала |
| 6 | низ-право | `about-4` | — (резерв) | Проверка лебедки на испытательном стенде перед отгрузкой |

## Полотно 20 — Лебедки: дополнительные ракурсы

Файл: `canvases/canvas-20.png`

```text
Create ONE single ultra-high-resolution image, 16:9 landscape (target 7680x4320), divided into a clean grid of 3 columns and 2 rows = 6 separate photographs of equal size, separated by thin straight white gutters (about 1% of the width). Each cell is an independent photo with its own composition; nothing crosses the gutters.

Global style for all six photos: Photorealistic professional industrial documentary photography, shot on a full-frame camera with 35mm and 50mm lenses, natural daylight, realistic colors, sharp focus, high dynamic range. Setting: Russia / Kazakhstan / CIS — realistic urban and rural landscapes, birch trees, Soviet-era and modern buildings, overcast or clear sky. Workers wear navy-blue workwear with high-visibility safety-yellow stripes and white or yellow hard hats, safety glasses and gloves. Equipment is painted dark navy blue with safety-yellow details. Absolutely no text, no letters, no logos, no brand names, no watermarks, no captions anywhere in the image.

Photo 1 (top-left): Close-up of a worker tailing a rope on a small capstan winch drum with several wraps, hands in gloves.
Photo 2 (top-center): Close-up of petrol winch control panel: throttle, hydraulic speed lever, digital force display, emergency stop.
Photo 3 (top-right): Roadside installation of fiber cable into an HDPE duct with a compact winch, traffic cones, rural highway.
Photo 4 (bottom-left): Close-up of orange synthetic rope neatly spooled on the storage drum of a diesel winch with level wind mechanism.
Photo 5 (bottom-center): Rope under tension coming out of an HDPE pipe at the exit pit of an HDD crossing, winch in background, river visible.
Photo 6 (bottom-right): Operator seated at the control station of a heavy winch with protective screen, monitoring a large display, focused expression.

Remember: no text, no numbers, no logos, no watermarks in any of the six photos.
```

| № | Позиция | Слот (имя файла) | Где на сайте | Alt-текст |
|---|---|---|---|---|
| 1 | верх-лево | `winch-petrol-small-2` | /oborudovanie/kabelnye-lebedki/benzinovye/do-1-tonny/ | Кабестан с ручной подтяжкой каната |
| 2 | верх-центр | `winch-petrol-3t-2` | /oborudovanie/kabelnye-lebedki/benzinovye/1-3-tonny/ | Пульт управления бензиновой лебедкой с индикатором усилия |
| 3 | верх-право | `winch-petrol-fiber-2` | /oborudovanie/kabelnye-lebedki/benzinovye/dlya-vols/ | Протяжка ВОЛС в защитной трубе вдоль дороги |
| 4 | низ-лево | `winch-diesel-5t-2` | /oborudovanie/kabelnye-lebedki/dizelnye/3-5-tonn/ | Синтетический канат на накопительном барабане лебедки |
| 5 | низ-центр | `winch-diesel-10t-2` | /oborudovanie/kabelnye-lebedki/dizelnye/5-10-tonn/ | Протяжка кабеля в трубу ГНБ дизельной лебедкой |
| 6 | низ-право | `winch-diesel-20t-2` | /oborudovanie/kabelnye-lebedki/dizelnye/10-20-tonn/ | Оператор тяжёлой лебедки за пультом |

---

Всего слотов: 120. Без привязки к странице (резерв): 34. Слотов на сайте без промпта: 0.
