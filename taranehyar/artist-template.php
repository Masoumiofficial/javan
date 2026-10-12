<?php /* Template Name: خواننده ها */ get_header(); ?>
<?php get_template_part( 'inc/breadcrumbs' ); ?>
<div class="tarlanweb_center">
	<div id="centers_box">
		<div class="clear2"></div>
		<div class="song_boxs singers_box_tarlanweb">
			<div class="songs_title_box">
				<h3>لیست هنرمندان</h3>
				<div class="clear"></div>
			</div>

			<div class="song_boxs_posts">
				<?php
				$page        = max( 1, absint( get_query_var( 'paged' ) ) );
				$per_page    = 18;
				$offset      = ( $page - 1 ) * $per_page;
				$total_terms = get_terms(
					array(
						'taxonomy'   => 'singer',
						'hide_empty' => true,
						'fields'     => 'count',
					)
				);
				$total_terms = is_wp_error( $total_terms ) ? 0 : absint( $total_terms );
				$terms       = get_terms(
					array(
						'taxonomy'   => 'singer',
						'hide_empty' => true,
						'number'     => $per_page,
						'offset'     => $offset,
						'orderby'    => 'name',
						'order'      => 'ASC',
					)
				);
				?>
				<?php if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) : ?>
					<ul>
						<?php foreach ( $terms as $term ) : ?>
							<?php
							$term_link = get_term_link( $term );
							if ( is_wp_error( $term_link ) ) {
								continue;
							}
							$image     = function_exists( 'get_field' ) ? get_field( 'aimg2', $term ) : '';
							$image_url = '';
							if ( is_array( $image ) && isset( $image['url'] ) ) {
								$image_url = $image['url'];
							} elseif ( is_string( $image ) ) {
								$image_url = $image;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $term_link ); ?>">
									<?php if ( '' !== $image_url ) : ?>
										<img src="<?php echo esc_url( $image_url ); ?>" width="200" height="200" alt="<?php echo esc_attr( $term->name ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
									<?php else : ?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/def-singer.webp' ); ?>" width="200" height="200" alt="<?php echo esc_attr( $term->name ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
									<?php endif; ?>
									<span><?php echo esc_html( $term->name ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<div class="clear"></div>
			</div>
			<?php
			$total_pages = $per_page > 0 ? (int) ceil( $total_terms / $per_page ) : 0;
			if ( $total_pages > 1 ) :
				$big = 999999999;
				?>
				<div class="pagination_box_artist">
					<?php
					echo paginate_links(
						array(
							'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'  => '?paged=%#%',
							'current' => $page,
							'total'   => $total_pages,
						)
					);
					?>
				</div>
			<?php endif; ?>

			<div class="clear2"></div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
