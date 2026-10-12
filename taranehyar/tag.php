<?php get_header(); ?>
<?php get_template_part( 'inc/breadcrumbs' ); ?>
<?php
$term = get_queried_object();
$get_artist_field = function ( $key ) use ( $term ) {
    return function_exists( 'get_field' ) ? get_field( $key, $term ) : '';
};
$image     = $get_artist_field( 'aimg2' );
$image_url = '';
if ( is_array( $image ) && isset( $image['url'] ) ) {
    $image_url = $image['url'];
} elseif ( is_string( $image ) ) {
    $image_url = $image;
}
$social_links = array(
    'afacebook'  => 'facebook',
    'atelegram'  => 'telegram',
    'ainstagram' => 'instagram',
    'atwitter'   => 'twitter',
    'ayoutube'   => 'youtube',
);
$description = get_the_archive_description();
?>

<div class="tarlanweb_center">
	<div class="artist_box_tarlanweb">
		<?php
		$has_social_link = false;
		foreach ( $social_links as $field_key => $network ) {
			if ( ! empty( $get_artist_field( $field_key ) ) ) {
				$has_social_link = true;
				break;
			}
		}
		if ( '' !== $image_url || $has_social_link ) :
			?>
			<div class="artists_imsf">
				<?php if ( '' !== $image_url ) : ?>
					<img src="<?php echo esc_url( $image_url ); ?>" width="200" height="200" alt="<?php echo esc_attr( $term->name ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
				<?php endif; ?>
				<div class="socials_box">
					<span>صفحات مجازی هنرمند</span>
					<?php foreach ( $social_links as $field_key => $network ) : ?>
						<?php $social_url = $get_artist_field( $field_key ); ?>
						<?php if ( ! empty( $social_url ) ) : ?>
							<a href="<?php echo esc_url( $social_url ); ?>" class="icofont-<?php echo esc_attr( 'telegram' === $network ? 'paper-plane' : ( 'youtube' === $network ? 'youtube-play' : $network ) ); ?>" aria-label="<?php echo esc_attr( $network ); ?>"></a>
						<?php endif; ?>
					<?php endforeach; ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>
		<div class="artist_box_detss">
			<h1 class="artist_name_head"><?php echo esc_html( single_term_title( '', false ) ); ?></h1>
			<div class="clear"></div>
			<?php if ( ! empty( $description ) ) : ?>
				<div class="artist_txt_box">
					<?php echo wp_kses_post( $description ); ?>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div id="artist_box">

<!-- centers_box -->
<div class="tarlanweb_center">
<div id="centers_box">

<!-- song_boxs -->
<div class="song_boxs">
<?php if(have_posts()) : ?>
<div class="song_boxs_posts">
<ul>
<?php while(have_posts()) : the_post(); ?>
<li><?php get_template_part('inc/songs_post'); ?></li>
<?php endwhile; ?>
</ul>
<div class="clear"></div>
</div>
<?php else: get_template_part('inc/no-content'); endif; ?>
<div class="clear"></div>
</div>
<!-- song_boxs -->	
	
	
	
<?php get_template_part('inc/pagination'); ?>
<div class="clear"></div>
</div>
</div>
<!-- centers_box -->
</div>

<?php get_footer(''); ?>