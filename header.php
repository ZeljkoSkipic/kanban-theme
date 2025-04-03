<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package s-tier
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<meta name="theme-color" content="#06C6A8" />

	<?php echo get_field('head_script', 'option'); ?> <!-- Head External Code -->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php echo get_field('body_top_script', 'option'); ?> <!-- Body Top External Code -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'stier' ); ?></a>

	<div class="top-bar">
		<div class="top_bar_inner container"><a href="/pricing"><strong>Kanban Plugin</strong> Early Access is available. Grab one of the <strong><em>Unlimited Access</em></strong> plans with a <strong><em>Permanant</em></strong> 20% discount.</a></div>
	</div>
	<header id="masthead" class="header-main">

		<div class="header-main_inner container">
			<figure class="site-logo">
				<?php
				the_custom_logo(); ?>
			</figure><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<!-- Mobile Nav Button -->
				<div class="hamburger">
				<label for="nav-toggle">Navigation Menu</label>
				<input type="checkbox" class="menu-toggle" id="nav-toggle">

				<div></div></div>
				<!-- Mobile Nav Button -->
				<div class="main-menu-wrap">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main',
							'menu_id'        => 'primary-menu',
							'walker'		 => new CustomMenuWalker
						)
					);
					?>
					<div class="header-main_right">
						<?php
						$nav_btn_1 = get_field('nav_btn_1', 'option');
						if( $nav_btn_1 ):
							$nav_btn_1_url = $nav_btn_1['url'];
							$nav_btn_1_title = $nav_btn_1['title'];
							$nav_btn_1_target = $nav_btn_1['target'] ? $nav_btn_1['target'] : '_self';
							?>
							<a class="btn-2 btn-icon" href="<?php echo esc_url( $nav_btn_1_url ); ?>" target="<?php echo esc_attr( $nav_btn_1_target ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1E92EB" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
								</svg>

								<span><?php echo esc_html( $nav_btn_1_title ); ?></span>
							</a>
						<?php endif; ?>

						<?php
						$nav_btn_2 = get_field('nav_btn_2', 'option');
						if( $nav_btn_2 ):
							$nav_btn_2_url = $nav_btn_2['url'];
							$nav_btn_2_title = $nav_btn_2['title'];
							$nav_btn_2_target = $nav_btn_2['target'] ? $nav_btn_2['target'] : '_self';
							?>
							<a class="btn-1" href="<?php echo esc_url( $nav_btn_2_url ); ?>" target="<?php echo esc_attr( $nav_btn_2_target ); ?>">
								<span><?php echo esc_html( $nav_btn_2_title ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</nav><!-- #site-navigation -->

		</div>
	</header><!-- #masthead -->
