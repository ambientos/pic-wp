		<?php if ( is_active_sidebar( 'after-content' ) ) : ?>
			<?php dynamic_sidebar( 'after-content' ); ?>
		<?php endif; ?>
	</main>

	<footer class="footer">
		<div class="container">
			<div class="footer-main row">
				<div class="col-lg-3 col-md-4">
					<div class="footer-logo d-md-block d-none">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php bloginfo( 'template_directory' ); ?>/i/logo.svg" width="191" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						</a>
						<div class="footer-title"><?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?></div>
					</div>
				</div>
				<div class="col-lg-5 col-md-8">
					<div class="footer-search">
						<form role="search" method="get" class="search-form" action="http://pic/">
							<span class="screen-reader-text"><?php _e( 'Search:', 'pic' ) ?></span>
							<input class="footer-search-control form-control-sm form-control" type="search" placeholder="<?php _e( 'Site search', 'pic' ); ?>" value="" name="s">
						</form>
					</div>
					<nav>
						<?php wp_nav_menu( array(
							'theme_location' => 'main_menu',
							'menu_class'     => 'footer-menu-columns footer-menu list-unstyled',
							'item_spacing'   => 'discard',
							'container'      => false,
						) ); ?>
					</nav>
				</div>
				<div class="col-lg-4">
					<div class="footer-callback">
						<?php if ( is_active_sidebar( 'footer-form' ) ) : ?>
							<?php dynamic_sidebar( 'footer-form' ); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="footer-contact d-md-flex">
				<?php $site_mail = get_option('pic_mail'); ?>
				<div class="footer-contact-item _mail-blue"><a href="mailto:<?php echo esc_attr( $site_mail ); ?>"><?php echo esc_html( $site_mail ); ?></a></div>
				<?php $site_phone = get_option('pic_tel'); ?>
				<div class="footer-contact-item _tel-blue"><a href="tel:<?php echo esc_attr( pic_get_phone_raw( $site_phone ) ); ?>" class="tel"><?php echo esc_html( $site_phone ); ?></a></div>
				<div class="footer-contact-item _mark-blue"><?php echo esc_html( get_option('pic_addr') ); ?></div>
			</div>
			<nav class="footer-nav-container row">
				<div class="col-md-3">
					<div class="footer-menu-title">Инжиниринг изделий</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Создание чертежей и 3D-моделей</a></li>
						<li><a href="/">Разработка литейных технологий</a></li>
						<li><a href="/">Подбор необходимого оборудования и технологической оснастки</a></li>
						<li><a href="/">Обследование производства и выработка рекомендаций по его модернизации</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Изготовление литейной оснастки</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Проектирование литейной технологии</a></li>
						<li><a href="/">Проектирование оснастки</a></li>
						<li><a href="/">Процесс изготовлени</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Проектирование и производство композитных изделий</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Услуга 1</a></li>
						<li><a href="/">Услуга 2</a></li>
						<li><a href="/">Услуга 3</a></li>
						<li><a href="/">Услуга 4</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Лабораторные исследования</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Лаборатория макро- и микроисследований</a></li>
						<li><a href="/">Лаборатория оптического контроля</a></li>
						<li><a href="/">Лаборатория прочностных испытаний</a></li>
						<li><a href="/">Лаборатория неразрушающего контроля</a></li>
						<li><a href="/">Лаборатория по определению твердости</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Изготовление отливок</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Литье в песчаные формы (холодно-твердеющие смеси)</a></li>
						<li><a href="/">Литье по выплавляемым моделям (точное литье)</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Механическая обработка</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Услуга 1</a></li>
						<li><a href="/">Услуга 2</a></li>
						<li><a href="/">Услуга 3</a></li>
						<li><a href="/">Услуга 4</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="footer-menu-title">Дополнительные услуги</div>
					<ul class="footer-nav-menu footer-menu list-unstyled">
						<li><a href="/">Термообработка</a></li>
						<li><a href="/">Дробеметная очистка</a></li>
						<li><a href="/">Гидропескоструйная очистка</a></li>
						<li><a href="/">Аргонодуговая сварка</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="footer-sub">
			<div class="container">
				<div class="d-md-flex justify-content-md-between">
					<div class="footer-copy"><?php echo esc_html( get_option('pic_cr') ); ?></div>
					<div class="footer-policy"><a href="/privacy-policy"><?php _e( 'Privacy Policy', 'pic' ); ?></a></div>
					<div class="footer-d"><?php echo esc_html( str_replace( '%%year%%', date( 'Y' ), get_option('pic_y') ) ); ?></div>
				</div>
			</div>
		</div>
	</footer>

	<div class="d-xl-none">
		<div class="mobile-menu-container">
			<div class="mobile-menu-inner">
				<nav class="mobile-main-menu mobile-menu">
					<?php wp_nav_menu( array(
						'theme_location' => 'main_menu',
						'item_spacing'   => 'discard',
						'container'      => false,
					) ); ?>
				</nav>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>
	</div>

	<?php if ( is_active_sidebar( 'sidebar-hidden' ) ) : ?>
		<div class="d-none">
			<?php dynamic_sidebar( 'sidebar-hidden' ); ?>
		</div>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>