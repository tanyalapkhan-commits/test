<?php
/**
 * Главная страница.
 *
 * Блоки: первый экран → преимущества → каталог оборудования → технологии прокладки →
 * аренда и сервис → отрасли → география (страны СНГ) → SEO-текст из редактора страницы.
 *
 * @package kabelpro
 */

get_header();

$equipment  = get_page_by_path( 'oborudovanie' );
$technology = get_page_by_path( 'tekhnologii' );
$industries = get_page_by_path( 'otrasli' );
$cities     = 0;
foreach ( kp_contacts_data() as $country ) {
	$cities += count( $country['cities'] );
}
?>

<section class="hero">
	<div class="hero__bg"><?php echo kp_photo_img( 'home-hero', 'Протяжка силового кабеля кабельной лебедкой на строительной площадке', 'hero__img', true ); // phpcs:ignore ?></div>
	<div class="container hero__inner">
		<div class="hero__content">
			<div class="hero__kicker">Продажа · Аренда · Сервис · Обучение</div>
			<h1 class="hero__title">Оборудование для прокладки кабеля</h1>
			<p class="hero__lead">Кабельные лебедки — бензиновые, дизельные, электрические и гидравлические, прицепы для кабельных барабанов, ролики, УЗК и инструмент. Подбираем комплект по расчёту тяжения для силовых кабелей 0,4–500 кВ и ВОЛС.</p>
			<div class="hero__actions">
				<a class="btn btn--accent btn--lg" href="#request" data-modal="request">Подобрать оборудование</a>
				<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( home_url( '/oborudovanie/kabelnye-lebedki/' ) ); ?>">Каталог лебедок</a>
			</div>
		</div>
		<ul class="hero__stats">
			<li><strong>0,5–20 т</strong><span>тяговое усилие лебедок</span></li>
			<li><strong>до 40 т</strong><span>масса барабана на прицепах и стойках</span></li>
			<li><strong><?php echo esc_html( $cities ); ?></strong><span>филиалов с офисом и складом</span></li>
			<li><strong><?php echo esc_html( count( kp_contacts_data() ) ); ?></strong><span>стран СНГ</span></li>
		</ul>
	</div>
</section>

<section class="section section--tight">
	<div class="container features">
		<div class="feature"><?php echo kp_icon( 'gauge', 'feature__icon' ); // phpcs:ignore ?><div class="feature__title">Расчёт тяжения бесплатно</div><p>Считаем усилие протяжки и боковое давление на кабель, подбираем лебедку с запасом.</p></div>
		<div class="feature"><?php echo kp_icon( 'shield', 'feature__icon' ); // phpcs:ignore ?><div class="feature__title">Контроль усилия</div><p>Лебедки с ограничителем тяги и регистратором — протокол протяжки для заказчика.</p></div>
		<div class="feature"><?php echo kp_icon( 'truck', 'feature__icon' ); // phpcs:ignore ?><div class="feature__title">Склады в регионах</div><p>Оборудование на складах филиалов — отгрузка в день обращения.</p></div>
		<div class="feature"><?php echo kp_icon( 'tools', 'feature__icon' ); // phpcs:ignore ?><div class="feature__title">Сервис и обучение</div><p>Шеф-монтаж на объекте, ТО, ремонт, обучение операторов лебедок.</p></div>
	</div>
</section>

<?php if ( $equipment ) : ?>
<section class="section">
	<div class="container">
		<div class="section__head">
			<h2 class="section__title">Каталог оборудования для прокладки кабеля</h2>
			<a class="section__link" href="<?php echo esc_url( get_permalink( $equipment ) ); ?>">Весь каталог <?php echo kp_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>
		<div class="cards">
			<?php foreach ( kp_child_pages( $equipment->ID ) as $child ) { echo kp_card_html( $child ); } // phpcs:ignore ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section section--dark">
	<div class="container split">
		<div class="split__media"><?php echo kp_photo_img( 'home-winch-diesel', 'Дизельная кабельная лебедка на прицепе с барабаном троса', 'split__img' ); // phpcs:ignore ?></div>
		<div class="split__text">
			<div class="kicker">Ключевая категория</div>
			<h2>Кабельные лебедки: бензиновые, дизельные, электрические</h2>
			<p>Лебедка — главный инструмент протяжки. От неё зависит, будет ли кабель уложен без превышения допустимого усилия и повреждения оболочки. Мы поставляем лебедки тяговым усилием от 0,5 до 20 т: компактные бензиновые капстанные модели для распределительных сетей и ВОЛС, мощные дизельные барабанные лебедки на прицепе для кабелей 110–500 кВ, электрические лебедки для работы в коллекторах и тоннелях, гидравлические — для работы от гидросистемы спецтехники.</p>
			<ul class="ticks ticks--light">
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Плавная регулировка скорости 0–40 м/мин</li>
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Ограничитель усилия с автоматической остановкой</li>
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Регистрация тяжения с выгрузкой протокола</li>
				<li><?php echo kp_icon( 'check' ); // phpcs:ignore ?> Трос или синтетический канат 300–1500 м</li>
			</ul>
			<div class="split__actions">
				<a class="btn btn--accent" href="<?php echo esc_url( home_url( '/oborudovanie/kabelnye-lebedki/benzinovye/' ) ); ?>">Бензиновые лебедки</a>
				<a class="btn btn--ghost-light" href="<?php echo esc_url( home_url( '/oborudovanie/kabelnye-lebedki/dizelnye/' ) ); ?>">Дизельные лебедки</a>
			</div>
		</div>
	</div>
</section>

<?php if ( $technology ) : ?>
<section class="section">
	<div class="container">
		<div class="section__head">
			<h2 class="section__title">Технологии прокладки кабеля</h2>
			<a class="section__link" href="<?php echo esc_url( get_permalink( $technology ) ); ?>">Все технологии <?php echo kp_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>
		<p class="section__lead">Разбираем каждую технологию: от разработки траншеи и затягивания кабеля в трубы до горизонтально-направленного бурения, пневмопрокладки ВОЛС и монтажа высоковольтных линий. Нормативы, расчёты, схемы расстановки оборудования.</p>
		<div class="cards cards--compact">
			<?php foreach ( kp_child_pages( $technology->ID ) as $child ) { echo kp_card_html( $child ); } // phpcs:ignore ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section section--alt">
	<div class="container services">
		<a class="service" href="<?php echo esc_url( home_url( '/arenda/' ) ); ?>">
			<span class="service__media"><?php echo kp_photo_img( 'home-rent', 'Аренда кабельной лебедки и прицепа для барабана', 'service__img' ); // phpcs:ignore ?></span>
			<span class="service__body"><span class="service__title">Аренда оборудования</span><span>Лебедки, прицепы, домкраты и ролики в аренду от 1 суток. Залог, доставка, инструктаж.</span></span>
		</a>
		<a class="service" href="<?php echo esc_url( home_url( '/servis/' ) ); ?>">
			<span class="service__media"><?php echo kp_photo_img( 'home-service', 'Сервисный инженер обслуживает кабельную лебедку', 'service__img' ); // phpcs:ignore ?></span>
			<span class="service__body"><span class="service__title">Сервис и ремонт</span><span>ТО, диагностика, ремонт двигателей и гидравлики, замена троса, поверка динамометров.</span></span>
		</a>
		<a class="service" href="<?php echo esc_url( home_url( '/servis/obuchenie/' ) ); ?>">
			<span class="service__media"><?php echo kp_photo_img( 'home-training', 'Обучение монтажной бригады работе с лебедкой', 'service__img' ); // phpcs:ignore ?></span>
			<span class="service__body"><span class="service__title">Обучение и шеф-монтаж</span><span>Обучение операторов, сопровождение первой протяжки, разработка ППР.</span></span>
		</a>
	</div>
</section>

<?php if ( $industries ) : ?>
<section class="section">
	<div class="container">
		<div class="section__head">
			<h2 class="section__title">Отрасли</h2>
			<a class="section__link" href="<?php echo esc_url( get_permalink( $industries ) ); ?>">Все отрасли <?php echo kp_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>
		<div class="cards cards--compact">
			<?php foreach ( kp_child_pages( $industries->ID ) as $child ) { echo kp_card_html( $child ); } // phpcs:ignore ?>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section section--alt">
	<div class="container">
		<div class="section__head">
			<h2 class="section__title">Филиалы в России и странах СНГ</h2>
			<a class="section__link" href="<?php echo esc_url( home_url( '/kontakty/' ) ); ?>">Все контакты <?php echo kp_icon( 'arrow' ); // phpcs:ignore ?></a>
		</div>
		<?php echo kp_contacts_directory_html(); // phpcs:ignore ?>
	</div>
</section>

<?php
while ( have_posts() ) :
	the_post();
	$content = apply_filters( 'the_content', get_the_content() );
	if ( trim( wp_strip_all_tags( $content ) ) ) :
		?>
		<section class="section">
			<div class="container layout layout--toc">
				<aside class="layout__aside"><div class="sticky"><?php echo kp_toc_html(); // phpcs:ignore ?></div></aside>
				<article class="layout__main content content--home"><?php echo $content; // phpcs:ignore ?></article>
			</div>
		</section>
		<?php
	endif;
endwhile;

get_footer();
