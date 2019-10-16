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
					</div>
				</div>
				<div class="col-lg-5 col-md-8">
					<?php get_search_form(); ?>

					<nav>
						<?php wp_nav_menu( array(
							'theme_location' => 'sub_menu',
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
				<?php if ( is_active_sidebar( 'footer-menu-list' ) ) : ?>
					<?php dynamic_sidebar( 'footer-menu-list' ); ?>
				<?php endif; ?>
			</nav>
		</div>
		<div class="footer-sub">
			<div class="container">
				<div class="d-md-flex justify-content-md-between">
					<div class="footer-copy"><?php echo esc_html( get_option('pic_cr') ); ?></div>
					<div class="footer-policy"><a href="<?php echo esc_url( get_option('pic_pp') ); ?>" target="_blank"><?php _e( 'Privacy Policy', 'pic' ); ?></a></div>
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

	<?php if ( pic_is_show_ad() ) : ?>
		<?php echo get_option('pic_ac'); ?>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>