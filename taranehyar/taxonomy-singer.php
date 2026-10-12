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
$term_slug = isset( $term->slug ) ? $term->slug : '';
$artist_query_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 1,
    'tax_query'      => array(
        array(
            'taxonomy' => 'singer',
            'field'    => 'slug',
            'terms'    => $term_slug,
        ),
    ),
);
$query  = new WP_Query( array_merge( $artist_query_args, array( 'meta_query' => array( array( 'key' => 'musics_type', 'value' => 'mp3', 'compare' => '=' ) ) ) ) );
$query1 = new WP_Query( array_merge( $artist_query_args, array( 'meta_query' => array( array( 'key' => 'musics_type', 'value' => 'mp4', 'compare' => '=' ) ) ) ) );
$query2 = new WP_Query(
	array_merge(
		$artist_query_args,
		array( 'meta_query' => array( array( 'key' => 'musics_type', 'value' => 'album', 'compare' => '=' ) ) )
	)
);
$description = get_the_archive_description();
?>

<div class="tarlanweb_center">
	<div class="artist_box_tarlanweb">
		<div class="artists_imsf">
			<?php if ( '' !== $image_url ) : ?>
				<img src="<?php echo esc_url( $image_url ); ?>" width="200" height="200" alt="<?php echo esc_attr( $term->name ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/images/def-singer.webp' ); ?>" width="200" height="200" alt="<?php echo esc_attr( $term->name ); ?>" title="<?php echo esc_attr( $term->name ); ?>">
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

		<div class="artist_box_detss">
			<h1 class="artist_name_head">دانلود آهنگ‌های <?php echo esc_html( single_term_title( '', false ) ); ?></h1>
			<ul class="artist_resume_box">
				<?php if ( $query->have_posts() ) : ?><li><?php echo absint( $query->found_posts ); ?> آهنگ</li><?php endif; ?>
				<?php if ( $query1->have_posts() ) : ?><li><?php echo absint( $query1->found_posts ); ?> موزیک ویدیو</li><?php endif; ?>
				<?php if ( $query2->have_posts() ) : ?><li><?php echo absint( $query2->found_posts ); ?> آلبوم</li><?php endif; ?>
			</ul>
			<div class="clear2"></div>
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

<?php $queried_object=get_queried_object(); $term_id = $queried_object->slug;
$rkianoosh= new WP_Query(array('post_type'=>'post','posts_per_page'=>'-1','orderby'=>'date','order'=>'DESC',
'meta_query'=>array(array('key'=>'musics_type','value'=>'album','compare'=>'=')),
'tax_query'=>array(array('taxonomy'=>'singer','field'=>'slug','terms'=>$term_id,'operator'=>'IN')),
)); if($rkianoosh->have_posts()) : ?>
<!-- song_boxs -->
<div class="song_boxs">
<div class="songs_title_box">
<h3>آلبوم ها</h3>
<div class="clear"></div><div class="liner"></div>
</div>
<div class="song_boxs_posts">
<ul>
<?php while($rkianoosh->have_posts()) : $rkianoosh->the_post();?> 
<li><?php get_template_part('inc/songs_post'); ?></li>
<?php endwhile; wp_reset_postdata(); ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- song_boxs -->
<?php endif; ?>

<?php $queried_object = get_queried_object(); $term_id = $queried_object->slug;
$my_query= new WP_Query(array('post_type'=>'post','posts_per_page'=>'-1','orderby'=>'date','order'=>'DESC',
'meta_query'=>array(array('key'=>'musics_type','value'=>'mp3','compare'=>'=')),
'tax_query' => array(array('taxonomy'=>'singer','field'=>'slug','terms'=>$term_id,'operator'=>'IN')),
)); if($my_query->have_posts()) : ?>
<!-- song_boxs -->
<div class="song_boxs">
<div class="songs_title_box">
<h3>آهنگ ها</h3>
<div class="clear"></div><div class="liner"></div>
</div>
<div class="song_boxs_posts">
<ul>
<?php while($my_query->have_posts()) : $my_query->the_post();?> 
<li><?php get_template_part('inc/songs_post'); ?></li>
<?php endwhile; wp_reset_postdata(); ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- song_boxs -->
<?php endif; ?>

<?php $queried_object = get_queried_object(); $term_id = $queried_object->slug;
$my_custom= new WP_Query(array('post_type'=>'post','posts_per_page'=>'-1','orderby'=>'date','order'=>'DESC',
'meta_query'=>array(array('key'=>'musics_type','value'=>'mp4','compare'=>'=')),
'tax_query'=>array(array('taxonomy'=>'singer','field'=>'slug','terms'=>$term_id,'operator'=>'IN')),
)); if($my_custom->have_posts()) : ?>
<!-- song_boxs -->
<div class="song_boxs">
<div class="songs_title_box">
<h3>موزیک ویدیو ها</h3>
<div class="clear"></div><div class="liner"></div>
</div>
<div class="song_boxs_posts">
<ul>
<?php while($my_custom->have_posts()) : $my_custom->the_post();?> 
<li><?php get_template_part('inc/songs_post'); ?></li>
<?php endwhile; wp_reset_postdata(); ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- song_boxs -->
<?php endif; ?>

<div class="clear"></div>
</div>
</div>
<!-- centers_box -->

</div>

<?php get_footer(''); ?>