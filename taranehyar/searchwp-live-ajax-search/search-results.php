<?php
/*
 * Original theme design attribution found in the supplied archive:
 * Reza Kianoosh / Tarlanweb.ir.
 */
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="searchwp-live-search-result" role="option" id="searchwp-live-search-result-<?php echo absint( get_the_ID() ); ?>" aria-selected="false">
			<p>
				<a href="<?php echo esc_url( get_permalink() ); ?>">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'thumb4' ); } ?>
					<?php
					$artist = function_exists( 'get_field' ) ? get_field( 'artist' ) : '';
					$song   = function_exists( 'get_field' ) ? get_field( 'song' ) : '';
					if ( $artist || $song ) :
						echo esc_html( $artist );
						?>
						<span><?php echo esc_html( $song ); ?></span>
					<?php else : ?>
						<?php echo esc_html( get_the_title() ); ?>
					<?php endif; ?>
				</a>
			</p>
		</div>
	<?php endwhile; ?>
<?php else : ?>
	<p class="searchwp-live-search-no-results" role="option"><em>نتیجه‌ای یافت نشد!</em></p>
<?php endif; ?>
