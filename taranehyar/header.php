<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<head>
	<title><?php echo esc_html( ( is_front_page() || is_home() ) ? get_bloginfo( 'name' ) : wp_title( '', false ) ); ?></title>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#185ADB">
	<meta name="apple-mobile-web-app-status-bar-style" content="#185ADB">
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<link rel="alternate" href="<?php echo esc_url( get_feed_link( 'rss2' ) ); ?>" type="application/rss+xml" title="RSS 2.0">
	<link rel="icon" href="<?php echo esc_url( ot_get_option( 'favicon' ) ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/images/taranehyar-touch-icon.png' ); ?>">
	<?php
	wp_enqueue_script( 'jquery' );
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_head();
	?>
	<?php if ( wp_is_mobile() ) : ?>
		<style>body{padding-top:60px;}</style>
	<?php endif; ?>
</head>
<?php $dark_modes = ot_get_option( 'dark_modes' ); ?>
<body <?php body_class( 'off' !== $dark_modes ? 'night' : '' ); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<?php if ( ! wp_is_mobile() ) : ?>
	<header id="header">
		<div class="tarlanweb_center">
			<?php if ( is_home() ) : ?>
				<h1 class="h1_hidden_home"><?php echo esc_html( ot_get_option( 'head_h1' ) ); ?></h1>
			<?php endif; ?>
			<div class="logo_top">
				<figure>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( ot_get_option( 'logo' ) ); ?>" width="150" height="40" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
				</figure>
			</div>
			<nav class="menu_right">
				<?php wp_nav_menu( array( 'theme_location' => 'top_menu', 'menu_id' => 'rkianoosh_ir', 'container' => '' ) ); ?>
				<div class="clear"></div>
			</nav>
			<form id="searches" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input id="lsds" class="meta searchfield" name="s" placeholder="جستجو ..." type="search" data-swplive="true">
				<button type="submit" aria-label="جستجو"><i class="icofont-search" aria-hidden="true"></i></button>
			</form>

			<?php $enable_toggle = ot_get_option( 'sun_moon' ); if ( 'off' !== $enable_toggle ) : ?>
				<div class="dark_light_mode<?php echo 'off' !== $dark_modes ? ' dark_active' : ''; ?>">
					<i aria-label="moon" class="icofont-moon"></i>
					<div class="toggle_modes"></div>
					<i aria-label="sun" class="icofont-sun"></i>
				</div>
			<?php endif; ?>
			<div class="clear"></div>
		</div>
	</header>
<?php endif; ?>
<main>
