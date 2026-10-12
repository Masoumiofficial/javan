<header id="mobiles_header">
	<div class="logo_mobiles">
		<figure>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( ot_get_option( 'logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="150" height="40"></a>
		</figure>
	</div>
	<div class="navicon"><i class="responsive-menu-button-inner"></i></div>
	<div class="circle_hlink search_mobile_box"><i class="icofont-search" aria-hidden="true"></i></div>
	<form class="searches_mobile" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input id="lsds_mobile" class="meta searchfield" name="s" data-swplive="true" placeholder="کلمهٔ مورد نظر ..." type="search">
		<button type="submit" aria-label="جستجو"><i class="icofont-search" aria-hidden="true"></i></button>
	</form>
	<div class="mobile_box">
		<div class="bodydeactive"></div>
		<div class="mobiles_menu">
			<div class="top_logo_title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( ot_get_option( 'logo' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="150" height="40"></a>
				<div class="clear"></div>
			</div>
			<?php
			$mobile_walker = class_exists( 'CSS_Menu_Maker_Walker' ) ? new CSS_Menu_Maker_Walker() : null;
			wp_nav_menu(
				array(
					'theme_location' => 'mobiles_menu',
					'container_id'  => 'cssmenu',
					'walker'        => $mobile_walker,
				)
			);
			?>
			<div class="clear"></div>
			<div class="socials_box">
				<?php
			$mobile_socials = array(
				'facebook'  => array( 'class' => 'icofont-facebook', 'label' => 'Facebook' ),
				'instagram' => array( 'class' => 'icofont-instagram', 'label' => 'Instagram' ),
				'telegram'  => array( 'class' => 'icofont-paper-plane', 'label' => 'Telegram' ),
				'twitter'   => array( 'class' => 'icofont-twitter', 'label' => 'Twitter' ),
				'youtube'   => array( 'class' => 'icofont-youtube-play', 'label' => 'YouTube' ),
				'aparat'    => array( 'class' => 'icofont-movie', 'label' => 'Aparat' ),
			);
			foreach ( $mobile_socials as $option_key => $social ) :
				$social_url = ot_get_option( $option_key );
				if ( empty( $social_url ) ) {
					continue;
				}
				?>
				<a target="_blank" rel="noreferrer noopener nofollow" href="<?php echo esc_url( $social_url ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" class="<?php echo esc_attr( $social['class'] ); ?>"></a>
			<?php endforeach; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</header>
