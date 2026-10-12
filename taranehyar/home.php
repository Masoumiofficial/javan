<?php get_header(''); ?>
<!-- centers_box -->
<div class="tarlanweb_center">
<div id="centers_box">
<?php get_template_part('inc/vip_slider'); ?>
<?php get_template_part('inc/tarlanweb_player'); ?>
<?php get_template_part('inc/new_posts'); ?>
<?php get_template_part('inc/mostviews_posts'); ?>
<?php $artista = ot_get_option( 'hty', array() ); if ( ! is_array( $artista ) ) { $artista = array(); } foreach ( $artista as $artise ) { ?>	
<!-- song_boxs -->
<div class="song_boxs">
<div class="songs_title_box">
<h3><?php echo esc_html( isset( $artise['title'] ) ? $artise['title'] : '' ); ?></h3>
<?php $category_id = isset( $artise['hty-cat'] ) ? absint( $artise['hty-cat'] ) : 0; $category_link = get_category_link( $category_id ); ?>
<a href="<?php echo esc_url($category_link); ?>">مشاهده بیشتر</a>
<div class="clear"></div>
<div class="liner"></div>
</div>
<div class="song_boxs_posts">
<ul>
<?php $cat_ft1 = isset( $artise['hty-cat'] ) ? absint( $artise['hty-cat'] ) : 0; $num_ft1 = isset( $artise['hty-t'] ) ? absint( $artise['hty-t'] ) : 0;
$my_custom_query= new WP_Query(array(
'post_type' => 'post',
'post_status' => 'publish',
'cat'   =>  $cat_ft1,
'orderby' => 'date',
'posts_per_page' =>$num_ft1
)); if($my_custom_query->have_posts()) : ?>
<?php while($my_custom_query->have_posts()) : $my_custom_query->the_post(); $post_id=get_the_ID(); ?>
<li><?php get_template_part('inc/songs_post'); ?></li>
<?php endwhile; endif; wp_reset_postdata(); ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<!-- song_boxs -->
<?php } ?>
<?php get_template_part('inc/artist_slider'); ?>
<div class="clear"></div>
</div>
</div>
<!-- centers_box -->
<?php get_footer(''); ?>