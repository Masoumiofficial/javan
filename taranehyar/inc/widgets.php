<?php 
function rkianosh_load_widget(){ register_widget( 'tarlanweb_ir_newp' ); }
add_action( 'widgets_init', 'rkianosh_load_widget' ); 
class tarlanweb_ir_newp extends WP_Widget {
function __construct() {
parent::__construct(
'tarlanweb_ir_newp', '(اختصاصی) جدیدترین مطالب', 
array('description' => 'ابزارک نمایش جدیدترین مطالب با تصویر شاخص') 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'جدیدترین موسیقی ها', 'taranehyar' ) );
$post_numbers = absint( apply_filters( 'widget_numbers', isset( $instance['post_numbers'] ) ? $instance['post_numbers'] : 7 ) ); if ( 0 === $post_numbers ) { $post_numbers = 7; }
$link_target = ! empty( $instance['targets'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
?>
<?php  
$arms = array(
'post_type' => 'post',
'posts_per_page' => $post_numbers,'ignore_sticky_posts' => 1,
'orderby' => 'id',
'order' => 'DESC',
'post_status' => 'publish',
);
$widget_query = new WP_Query($arms); if($widget_query->have_posts()) : ?>
<ul>
<?php while ($widget_query->have_posts()) : $widget_query->the_post(); $post_id = $widget_query->post->ID; ?>
<li><a href="<?php echo esc_url( get_permalink() ); ?>"<?php echo $link_target; ?>>
<div class="img_rkianoosh_box"><?php if ( is_singular() && (int) get_queried_object_id() === (int) get_the_ID() ){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?></div>
<?php $artist=get_post_meta(get_the_ID(),'artist',true); $track=get_post_meta(get_the_ID(),'song',true);
if(isset($artist) && !empty($artist)){?> <span class="song_artists"> <?php echo esc_html( $artist ); ?> </span> <span> <?php echo esc_html( $track ); ?> </span> <?php } else{ echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?>
</ul>
<?php endif; wp_reset_postdata(); ?>
<?php
echo $args['after_widget'];
}
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'جدیدترین موسیقی ها', 'taranehyar' );
}
if ( isset( $instance[ 'post_numbers' ] ) ) {
$post_numbers = $instance[ 'post_numbers' ];
}
else {
$post_numbers = 7;
}
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">عنوان: </label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>">تعداد مطالب قابل نمایش:</label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_numbers' ) ); ?>" type="text" value="<?php echo esc_attr( $post_numbers ); ?>" />
</p>
<p>
<input class="checkbox" type="checkbox" <?php checked( ! empty( $instance['targets'] ), true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"/> 
<label for="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>">باز شدن لینک در تب جدید</label>
</p>
<?php 
}
public function update($new_instance,$old_instance){
$instance = array();
$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
$instance['post_numbers'] = isset( $new_instance['post_numbers'] ) ? max( 1, absint( $new_instance['post_numbers'] ) ) : 7;
$instance['targets'] = ! empty( $new_instance['targets'] ) ? 'on' : '';
return $instance;
}
}
// end ne post by thumbnail
function tarlanweb_load_widget(){register_widget('tarlanweb_ir_popular');}
add_action( 'widgets_init', 'tarlanweb_load_widget'); 
class tarlanweb_ir_popular extends WP_Widget {
function __construct(){
parent::__construct(
'tarlanweb_ir_popular','(اختصاصی) موسیقی محبوب (بازدید)', 
array('description' => 'ابزارک نمایش موسیقی های محبوب بر اساس بازدید') 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'پربازدیدترین موسیقی ها', 'taranehyar' ) );
$post_numbers = absint( apply_filters( 'widget_numbers', isset( $instance['post_numbers'] ) ? $instance['post_numbers'] : 7 ) ); if ( 0 === $post_numbers ) { $post_numbers = 7; }
$link_target = ! empty( $instance['targets'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
?>
<ul>
<?php 
$arms = array(
'post_type' => 'post',
'posts_per_page' => $post_numbers,'ignore_sticky_posts' => 1,
'offset' => 0,
'meta_key'  => 'views',
'orderby' => 'meta_value_num',
'order' => 'DESC',
'post_status' => 'publish',
'date_query' => array(
array(
'column' => 'post_date_gmt',
'after' => '11 month ago',
)));
$widget_query = new WP_Query($arms);
if ($widget_query->have_posts()) : while ($widget_query->have_posts()) : $widget_query->the_post(); $post_id = $widget_query->post->ID; ?>
<li><a href="<?php echo esc_url( get_permalink() ); ?>"<?php echo $link_target; ?>>
<div class="img_rkianoosh_box"><?php if ( is_singular() && (int) get_queried_object_id() === (int) get_the_ID() ){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?></div>
<?php $artist=get_post_meta(get_the_ID(),'artist',true); $track=get_post_meta(get_the_ID(),'song',true);
if(isset($artist) && !empty($artist)){?> <span class="song_artists"> <?php echo esc_html( $artist ); ?> </span> <span> <?php echo esc_html( $track ); ?> </span> <?php } else{ echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; wp_reset_postdata(); else : ?>
<li><?php esc_html_e( 'چیزی برای نمایش وجود ندارد', 'taranehyar' ); ?></li>
<?php endif; wp_reset_postdata(); ?>
</ul>
<?php
echo $args['after_widget'];
}
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'پربازدیدترین موسیقی ها', 'taranehyar' );
}
if ( isset( $instance[ 'post_numbers' ] ) ) {
$post_numbers = $instance[ 'post_numbers' ];
}
else {
$post_numbers = 7;
}
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">عنوان :</label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>">تعداد مطالب قابل نمایش:</label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_numbers' ) ); ?>" type="text" value="<?php echo esc_attr( $post_numbers ); ?>" />
</p>
<p>
<input class="checkbox" type="checkbox" <?php checked( ! empty( $instance['targets'] ), true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"/> 
<label for="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>">باز شدن لینک در تب جدید</label>
</p>
<?php 
}
public function update($new_instance,$old_instance){
$instance = array();
$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
$instance['post_numbers'] = isset( $new_instance['post_numbers'] ) ? max( 1, absint( $new_instance['post_numbers'] ) ) : 7;
$instance['targets'] = ! empty( $new_instance['targets'] ) ? 'on' : '';
return $instance;
}
}
// end tabs1
function rknos_lod_wigt(){ register_widget( 'tarlanweb_ir_rand' ); }
add_action( 'widgets_init', 'rknos_lod_wigt' ); 
class tarlanweb_ir_rand extends WP_Widget {
function __construct() {
parent::__construct(
'tarlanweb_ir_rand', '(اختصاصی) مطالب تصادفی', 
array('description' => 'ابزارک نمایش مطالب تصادفی با تصویر شاخص') 
);
}
// Creating widget front-end
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : __( 'مطالب تصادفی', 'taranehyar' ) );
$post_numbers = absint( apply_filters( 'widget_numbers', isset( $instance['post_numbers'] ) ? $instance['post_numbers'] : 7 ) ); if ( 0 === $post_numbers ) { $post_numbers = 7; }
$link_target = ! empty( $instance['targets'] ) ? ' target="_blank" rel="noopener noreferrer"' : '';
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . wp_kses_post( $title ) . $args['after_title'];
?>
<?php  
$arms = array(
'post_type' => 'post',
'posts_per_page' => $post_numbers,'ignore_sticky_posts' => 1,
'orderby' => 'rand',
'order' => 'DESC',
'post_status' => 'publish',
);
$widget_query = new WP_Query($arms); if($widget_query->have_posts()) : ?>
<ul>
<?php while ($widget_query->have_posts()) : $widget_query->the_post(); $post_id = $widget_query->post->ID; ?>
<li><a href="<?php echo esc_url( get_permalink() ); ?>"<?php echo $link_target; ?>>
<div class="img_rkianoosh_box"><?php if ( is_singular() && (int) get_queried_object_id() === (int) get_the_ID() ){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?></div>
<?php $artist=get_post_meta(get_the_ID(),'artist',true); $track=get_post_meta(get_the_ID(),'song',true);
if(isset($artist) && !empty($artist)){?> <span class="song_artists"> <?php echo esc_html( $artist ); ?> </span> <span> <?php echo esc_html( $track ); ?> </span> <?php } else{ echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?>
</ul>
<?php endif; wp_reset_postdata(); ?>
<?php
echo $args['after_widget'];
}
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'مطالب تصادفی', 'taranehyar' );
}
if ( isset( $instance[ 'post_numbers' ] ) ) {
$post_numbers = $instance[ 'post_numbers' ];
}
else {
$post_numbers = 7;
}
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">عنوان: </label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>">تعداد مطالب قابل نمایش:</label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_numbers' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_numbers' ) ); ?>" type="text" value="<?php echo esc_attr( $post_numbers ); ?>" />
</p>
<p>
<input class="checkbox" type="checkbox" <?php checked( ! empty( $instance['targets'] ), true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'targets' ) ); ?>"/> 
<label for="<?php echo esc_attr( $this->get_field_id( 'targets' ) ); ?>">باز شدن لینک در تب جدید</label>
</p>
<?php 
}
public function update($new_instance,$old_instance){
$instance = array();
$instance['title'] = isset( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
$instance['post_numbers'] = isset( $new_instance['post_numbers'] ) ? max( 1, absint( $new_instance['post_numbers'] ) ) : 7;
$instance['targets'] = ! empty( $new_instance['targets'] ) ? 'on' : '';
return $instance;
}
}
// end random post by thumbnail