<div class="clear"></div>
</main>
<?php get_template_part( 'inc/mobiles_header' ); ?>

<?php $up_button = ot_get_option( 'upb' ); if ( 'off' !== $up_button ) : ?>
	<div class="top_page boxes_shadows"><i class="icofont-thin-up"></i></div>
<?php endif; ?>

<?php if ( ! wp_is_mobile() && 'off' !== ot_get_option( 'fixbtn' ) ) : ?>
	<div class="fix_bottom_right_box">
		<?php $telegram_url = ot_get_option( 'telegram' ); if ( ! empty( $telegram_url ) ) : ?>
			<a class="telegrams_ch" target="_blank" rel="noreferrer noopener nofollow" href="<?php echo esc_url( $telegram_url ); ?>"><?php echo esc_html( ot_get_option( 'teltxt' ) ); ?></a>
		<?php endif; ?>
		<?php $instagram_url = ot_get_option( 'instagram' ); if ( ! empty( $instagram_url ) ) : ?>
			<a class="instagrms_ch" target="_blank" rel="noreferrer noopener nofollow" href="<?php echo esc_url( $instagram_url ); ?>"><?php echo esc_html( ot_get_option( 'instxt' ) ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<footer id="footer">
	<div class="tarlanweb_center">
		<nav>
			<?php wp_nav_menu( array( 'theme_location' => 'ft_menu', 'menu_id' => 'tarlanweb_ir', 'container' => '' ) ); ?>
			<div class="clear"></div>
		</nav>
		<div class="socials_box">
			<?php
			$footer_socials = array(
				'facebook'  => array( 'class' => 'icofont-facebook', 'label' => 'Facebook' ),
				'instagram' => array( 'class' => 'icofont-instagram', 'label' => 'Instagram' ),
				'telegram'  => array( 'class' => 'icofont-paper-plane', 'label' => 'Telegram' ),
				'twitter'   => array( 'class' => 'icofont-twitter', 'label' => 'Twitter' ),
				'youtube'   => array( 'class' => 'icofont-youtube-play', 'label' => 'YouTube' ),
				'aparat'    => array( 'class' => 'icofont-movie', 'label' => 'Aparat' ),
			);
			foreach ( $footer_socials as $option_key => $social ) :
				$social_url = ot_get_option( $option_key );
				if ( empty( $social_url ) ) {
					continue;
				}
				?>
				<a target="_blank" rel="noreferrer noopener nofollow" href="<?php echo esc_url( $social_url ); ?>" aria-label="<?php echo esc_attr( $social['label'] ); ?>" class="<?php echo esc_attr( $social['class'] ); ?>"></a>
			<?php endforeach; ?>
			<div class="clear"></div>
		</div>
		<p><?php echo wp_kses_post( ot_get_option( 'copyright' ) ); ?></p>
		<div class="clear"></div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
