<?php $fixbvip = ot_get_option('fixbvip'); if('off' != $fixbvip){
$vip_np = absint( ot_get_option( 'vip_num' ) ); $my_custom_query= new WP_Query(
array('post_type'=>'post','post_status'=>'publish','posts_per_page'=>$vip_np,
'meta_query'=>array(array('key'=>'vip_song','value'=>'1','compare'=>'LIKE')) ));
if($my_custom_query->have_posts()) : ?>
<!-- vip_img_box -->
<div class="vip_img_box">
<div class="vip_top_slider owl-carousel owl-theme">
<?php $rkian=1; while($my_custom_query->have_posts()) : $my_custom_query->the_post();?>
<article class="vip_post">
<header>
<figure><a href="<?php echo esc_url( get_permalink() ); ?>">
<?php $vip_image = function_exists( 'get_field' ) ? get_field( 'vip_img' ) : ''; if ( $vip_image ) { ?>
<img src="<?php echo esc_url( $vip_image ); ?>" width="640" height="360" alt="<?php echo esc_attr( get_the_title() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
<?php } else{if(has_post_thumbnail()){
the_post_thumbnail('thumb1',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/vip_img.jpg' ); ?>" width="640" height="360" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } } ?></a></figure>
<h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php $artist = function_exists( 'get_field' ) ? get_field( 'artist' ) : ''; $song = function_exists( 'get_field' ) ? get_field( 'song' ) : ''; if ( $artist || $song ) { ?> <?php echo esc_html( $artist ); ?> - <span><?php echo esc_html( $song ); ?></span><?php } else { echo esc_html( get_the_title() ); } ?></a></h2>
</header>	
<footer>
<?php $field=get_field_object('musics_type'); if($field){
$value = isset( $field['value'] ) ? $field['value'] : ''; ?>
<span class="ft_box_format"><?php echo esc_html( $value ); ?></span><?php } ?>
</footer>
<div class="clear"></div>
</article>
<?php $rkian++; endwhile; ?>
</div>
<div class="clear"></div>
</div>
<!-- vip_img_box -->
<?php endif; wp_reset_postdata(); } ?>