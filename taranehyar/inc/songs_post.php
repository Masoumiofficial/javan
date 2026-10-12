<article class="songs_post">
<header>
<figure><a rel="nofollow" href="<?php the_permalink(); ?>">
<?php if(has_post_thumbnail()){ if(wp_is_mobile()){the_post_thumbnail('thumb4',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().''));
}else{the_post_thumbnail('thumb2',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().''));}
} else { ?><img src="<?php bloginfo('template_url');?>/images/nomusics.jpg" width="190" height="190" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?></a></figure>
<h2><a href="<?php the_permalink(); ?>"><?php $artist = function_exists( 'get_field' ) ? get_field( 'artist' ) : ''; $song = function_exists( 'get_field' ) ? get_field( 'song' ) : ''; if ( $artist || $song ) { ?> <?php echo esc_html( $artist ); ?><span><?php echo esc_html( $song ); ?></span><?php } else { echo esc_html( get_the_title() ); } ?></a></h2>
</header>
<footer>
<?php $field=get_field_object('musics_type'); if($field){
$value = isset( $field['value'] ) ? $field['value'] : ''; ?>
<span class="ft_box_format"><?php echo esc_html( $value ); ?></span><?php } ?>
</footer>
</article>