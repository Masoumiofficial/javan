<?php get_header(''); ?>
<?php get_template_part('inc/breadcrumbs'); ?>
<?php if((ot_get_option('ads_bt') !="") || (ot_get_option('adsjs_bt') !="")){ ?>
<div id="ads_top">
<?php echo ot_get_option('ads_bt'); ?><?php echo ot_get_option('adsjs_bt'); ?>
<div class="clear"></div>
</div>
<?php } ?>
<!-- centers_box -->
<div class="tarlanweb_center">
<div id="centers_box">

<!-- single_posts_right -->
<div class="single_posts_right">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article class="single_posts tarlanweb_post_box">
<header>
<h1><?php echo esc_html( get_the_title() ); ?></h1> 
<div class="stars_ratings_box">
<?php include_once(ABSPATH .'wp-admin/includes/plugin.php');
if(is_plugin_active('kk-star-ratings/index.php')){ echo kk_star_ratings(); } ?>
</div>
<div class="liner clear"></div>
<div class="tarlanweb_post_ft"><i class="icofont-folder-open"></i> <?php the_category(' , '); ?></div>
<?php if(function_exists('the_views')){ ?>
<div class="tarlanweb_post_ft"><i class="icofont-eye-alt"></i> <?php the_views(); ?></div><?php } ?>
<div class="tarlanweb_post_ft"><i class="icofont-comment"></i> <?php comments_number('0','1','%'); ?></div><?php edit_post_link('ویرایش مطلب'); ?>
<div class="clear"></div>
</header>

<div class="single_content_box">

<?php
/* تصویر شاخص نوشته به‌صورت خودکار در ابتدای بخش توضیحات (محتوای مطلب) درج می‌شود
   تا نیازی به گذاشتن دستی همان تصویر داخل متن توضیحات نباشد.
   اندازهٔ نمایش را در متغیر زیر می‌توانید تغییر دهید:
   'large' یا 'full' = اندازهٔ اصلی/بزرگ تصویر | 'thumb1' = ۶۴۰×۳۶۰ | 'thumb2' = ۱۹۰×۱۹۰ */
$taranehyar_featured_size = 'large';
if ( has_post_thumbnail() ) {
	?>
	<div class="single_featured_cover">
		<figure class="single_featured_image">
			<?php the_post_thumbnail( $taranehyar_featured_size, array( 'alt' => get_the_title(), 'title' => get_the_title() ) ); ?>
		</figure>
	</div>
	<?php
} ?>

<?php the_content(''); ?>

<div class="music_textss">
<?php echo wp_kses_post( get_field( 'music_text' ) ); ?>
<div class="clear"></div>
</div>
<div class="clear"></div>

<?php if(get_field('video720') || get_field('video1080') || get_field('video480')){ ?> 
<div class="video_player">
<video width="640" height="360" controls>
<source src="<?php if ( get_field( 'video480' ) ) { echo esc_url( get_field( 'video480' ) ); } elseif ( get_field( 'video720' ) ) { echo esc_url( get_field( 'video720' ) ); } else { echo esc_url( get_field( 'video1080' ) ); } ?>" type="video/mp4">
مرورگر شما قدیمی است و از پخش آنلاین پشتیبانی نمیکند. بروز باش عزیز من
</video> 
</div>
<?php } ?>

<?php if((ot_get_option('ads_sg') !="") || (ot_get_option('adsjs_sg') !="")){ ?>
<div id="ads_top_dl"><?php echo ot_get_option('ads_sg'); ?><?php echo ot_get_option('adsjs_sg'); ?><div class="clear"></div></div>
<?php } ?>


<?php if(get_field('music128')){ ?> 
<!-- music player -->
<div class="music_box_player taktarcks">
<audio id="audio" preload="none" tabindex="0">
<source src="<?php echo esc_url( get_field( 'music128' ) ); ?>" data-track-number="1" />    
پلیر شما قدیمی است و از پخش آنلاین پشتیبانی نمیکند.
</audio>

 <div class="player">

<div class="player_controls">
<i class="previous-track-btn disabled"><span class="screen-reader-text">Previous track button</span></i>
<div class="large-toggle-btn"><i class="icofont-play-alt-1"><span class="screen-reader-text">Large toggle button</span></i></div>
<i class="next-track-btn"><span class="screen-reader-text">Next track button</span></i>

</div>
    <div class="info-box">
      <div class="track-info-box">
        <div class="track-title-text"> <?php echo esc_html( get_field( 'artist' ) ); ?> - <?php echo esc_html( get_field( 'song' ) ); ?> </div>
        <div class="audio-time">
        	<span class="duration">00:00</span> /
          <span class="current-time">00:00</span> 
        </div>
      </div>
      <!-- /.info-box -->
      <div class="progress-box">
        <div class="progress-cell">
          <div class="progress">
            <div class="progress-buffer"></div>
            <div class="progress-indicator"></div>
          </div>
        </div>
<div class="volume_box">
<i class="icofont-volume-bar"></i>
<input type="range" id="volume-bar" min="0" max="100" step="5" value="100">
</div>
      </div>
    </div>
    <!-- /.progress-box -->
  </div>
  <!-- /.player -->
<div class="play-list">
<div class="play-list-row" data-track-row="1">
<div class="small-toggle-btn">
<i class="small-play-btn"><span class="screen-reader-text">Small toggle button</span></i>
</div>
<div class="track-number">1.</div>
<div class="track-title"><?php if(get_field('song')){ ?><a class="playlist-track" href="#" data-play-track="1"><?php echo esc_html( get_field( 'artist' ) ); ?> - <?php echo esc_html( get_field( 'song' ) ); ?></a><?php } ?></div>
</div>
</div>
</div>
<!-- music player -->
<?php } ?>



<?php if( have_rows('album') ): ?>
<!-- album player -->
<div class="music_box_player">

<audio id="audio" preload="none" tabindex="0">
<?php $rkianoosh=1; while( have_rows('album') ): the_row(); ?>
<source src="<?php echo esc_url( get_sub_field( 'albumlink128' ) ? get_sub_field( 'albumlink128' ) : get_sub_field( 'albumlink320' ) ); ?>" data-track-number="<?php echo absint( $rkianoosh ); ?>" />
<?php $rkianoosh++; endwhile; ?>    
Your browser does not support HTML5 audio.
</audio>
<div class="player">
<div class="player_controls">
<i class="previous-track-btn disabled"><span class="screen-reader-text">Previous track button</span></i>
<div class="large-toggle-btn"><i class="icofont-play-alt-1"><span class="screen-reader-text">Large toggle button</span></i></div>
<i class="next-track-btn"><span class="screen-reader-text">Next track button</span></i>
</div>
<div class="info-box">
      <div class="track-info-box">
        <div class="track-title-text"> انتخاب قطعه </div>
        <div class="audio-time">
        	<span class="duration">00:00</span> /
          <span class="current-time">00:00</span> 
        </div>
      </div>
      <!-- /.info-box -->
      <div class="progress-box">
        <div class="progress-cell">
          <div class="progress">
            <div class="progress-buffer"></div>
            <div class="progress-indicator"></div>
          </div>
        </div>
<div class="volume_box">
<i class="icofont-volume-bar"></i>
<input type="range" id="volume-bar" min="0" max="100" step="5" value="100">
</div>
</div>
</div>
<!-- /.progress-box -->
</div>
<!-- /.player -->
<div class="play-list">
<?php $rkianoosh=1; while( have_rows('album') ): the_row(); ?>
<div class="play-list-row <?php if($rkianoosh % 2 == 0){echo 'plylodd';}?>" data-track-row="<?php echo absint( $rkianoosh ); ?>">
<div class="small-toggle-btn">
<i class="small-play-btn"><span class="screen-reader-text">Small toggle button</span></i>
</div>
<div class="track-number"><?php echo absint( $rkianoosh ); ?>.</div>
<div class="track-title"><?php if(get_sub_field('song_names')){ ?><a class="playlist-track" href="#" data-play-track="<?php echo absint( $rkianoosh ); ?>"><?php echo esc_html( get_sub_field( 'song_names' ) ); ?></a><?php } ?></div>
<div class="download_box">
<?php if(get_sub_field('albumlink128')){ ?>
<a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( get_sub_field( 'albumlink128' ) ); ?>">دانلود  128</a>
<?php } if(get_sub_field('albumlink320')){ ?>
<a target="_blank" rel="noopener noreferrer" href="<?php echo esc_url( get_sub_field( 'albumlink320' ) ); ?>">دانلود  320</a><?php } ?>
</div>
</div>
<?php $rkianoosh++; endwhile; ?> 
</div>
</div>
<!-- album player -->
<?php endif; ?>


<div class="dl_links_box">
<?php if(get_field('music128')){ ?> 
<a class="dl_link_128" href="<?php echo esc_url( get_field( 'music128' ) ); ?>"> <i class="icofont-download"></i>دانلود  آهنگ با کیفیت 128 </a><?php } if(get_field('music320')){ ?>
<a class="dl_links_320" href="<?php echo esc_url( get_field( 'music320' ) ); ?>"> <i class="icofont-download"></i> دانلود آهنگ با کیفیت 320 </a><?php } if(get_field('album128')){ ?>	
<a class="dl_link_128" href="<?php echo esc_url( get_field( 'album128' ) ); ?>"> <i class="icofont-download"></i>دانلود  آلبوم با کیفیت 128 </a><?php } if(get_field('album320')){ ?>
<a class="dl_links_320" href="<?php echo esc_url( get_field( 'album320' ) ); ?>"> <i class="icofont-download"></i> دانلود  آلبوم با کیفیت 320 </a>	<?php } ?>
<div class="clear"></div>
</div>
<?php if((get_field('video1080')) || (get_field('video720')) || (get_field('video480'))){ ?>
<div class="dl_linksv_box">
<ul>
<?php if(get_field('video1080')){ ?> 
<li><a href="<?php echo esc_url( get_field( 'video1080' ) ); ?>"> <i class="icofont-download"></i>دانلود  موزیک ویدیو با کیفیت  1080 </a></li><?php } if(get_field('video720')){ ?>
<li><a href="<?php echo esc_url( get_field( 'video720' ) ); ?>"> <i class="icofont-download"></i>دانلود  موزیک ویدیو با کیفیت  720 </a></li><?php } if(get_field('video480')){ ?>
<li><a href="<?php echo esc_url( get_field( 'video480' ) ); ?>"> <i class="icofont-download"></i>دانلود  موزیک ویدیو با کیفیت  480 </a></li><?php } ?>
</ul>
<div class="clear"></div>
</div>
<?php } ?>
<div class="clear"></div>
</div>

<footer>
<div class="tarlanweb_post_ft"><i class="icofont-clock-time"></i> <?php the_time('j F Y'); ?></div>
<div class="post-actions-input">
<div class="post-actions-right"><i class="icofont-link"></i>لینک کوتاه</div>
<input type="url" value="<?php echo esc_url( get_permalink() ); ?>" readonly="" onclick="this.setSelectionRange(0, this.value.length)">
<div class="clear"></div>
</div>
</footer>
<div class="clear"></div>
</article>
<?php endwhile; endif; ?>

<?php $share_off = ot_get_option( 'share_off' ); if ( 'off' !== $share_off ) :
	$share_permalink = get_permalink();
	$share_title     = get_the_title();
	$facebook_share  = add_query_arg( 'u', $share_permalink, 'https://www.facebook.com/sharer/sharer.php' );
	$twitter_share   = add_query_arg( array( 'text' => $share_title, 'url' => $share_permalink ), 'https://twitter.com/intent/tweet' );
	$whatsapp_share  = 'https://api.whatsapp.com/send?text=' . rawurlencode( $share_title . ' ' . $share_permalink );
	$telegram_share  = add_query_arg( array( 'url' => $share_permalink, 'text' => $share_title ), 'https://t.me/share/url' );
?>
<div class="single_posts socials_shares_box">
	<p>اشتراک گذاری مطلب</p>
	<div class="socials_shares">
		<a target="_blank" rel="noopener noreferrer nofollow" href="<?php echo esc_url( $facebook_share ); ?>"><i aria-label="facebook" class="icofont-facebook"></i></a>
		<a target="_blank" rel="noopener noreferrer nofollow" href="<?php echo esc_url( $twitter_share ); ?>"><i aria-label="twitter" class="icofont-twitter"></i></a>
		<a target="_blank" rel="noopener noreferrer nofollow" href="<?php echo esc_url( $whatsapp_share ); ?>"><i aria-label="whatsapp" class="icofont-whatsapp"></i></a>
		<a target="_blank" rel="noopener noreferrer nofollow" href="<?php echo esc_url( $telegram_share ); ?>"><i aria-label="telegram" class="icofont-paper-plane"></i></a>
	</div>
	<div class="clear"></div>
</div>
<?php endif; ?>

<?php $tag_off = ot_get_option('tag_off'); if('off' != $tag_off){ if ( has_tag( '', get_queried_object_id() ) ) { ?>
<div class="single_posts rkianoosh_tags_box">
<span> برچسب ها :</span> <?php the_tags('','',''); ?>
<div class="clear"></div>
</div>
<?php } } ?>
	
	

	
<?php $reltag1 = ot_get_option('reltag1'); if('off' != $reltag1){
$reltag = ot_get_option('reltag'); if('off' != $reltag){ ?>	
<?php $current_post_id = $post->ID; $pppr=ot_get_option('pppf'); $artist=get_field('artist');
$my_custom_query= new WP_Query(
array('post_type'=>'post','post_status'=>'publish','posts_per_page'=> $pppr,
'meta_query'=>array(array('key'=>'artist','value'=>$artist,'compare'=>'LIKE')), ));
if($my_custom_query->have_posts()) : ?>
<div class="related_posts rel_sing_bbt">
<h3 class="tarlanweb_side_titles">سایر آهنگهای <?php echo esc_html( $artist ); ?></h3>
<?php if(has_tag( '', $current_post_id ) ){ if(isset($artist) && !empty($artist)){ $post_tags = get_the_tags( $current_post_id ); foreach( $post_tags as $tag) :
if ( $tag->name === $artist ){ ?>
<div class="left_artists_pp"><a class="artist_songs_page" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی  <?php echo esc_html( $tag->name ); ?> </a></div>
<?php } endforeach; } } ?>
<div class="liner clear"></div>
<div class="tarlanweb_side_box">
<ul>
<?php while($my_custom_query->have_posts()) : $my_custom_query->the_post(); ?>
<li<?php if($current_post_id === $post->ID){ ?> class="inactive_songs"<?php } ?>><a href="<?php the_permalink(); ?>">
<div class="img_rkianoosh_box"><?php if($current_post_id === $post->ID){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?>
<?php if($current_post_id === $post->ID){ ?><div class="nowPlayingIcon"><span></span><span></span><span></span><span></span></div><?php } ?></div>
<?php $related_artist = get_post_meta( get_the_ID(), 'artist', true ); $related_track = get_post_meta( get_the_ID(), 'song', true );
if ( ! empty( $related_artist ) ) { ?> <span class="song_artists"> <?php echo esc_html( $related_artist ); ?> </span> <span> <?php echo esc_html( $related_track ); ?> </span> <?php } else { echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?>
<?php if(has_tag( '', $current_post_id ) ){ if(isset($artist) && !empty($artist)){ $post_tags = get_the_tags( $current_post_id ); foreach( $post_tags as $tag) :
if ( $tag->name === $artist ){ ?>
<li class="artist_songs_page_li mobile_more_artist"><a class="artist_songs_page" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی  <?php echo esc_html( $tag->name ); ?> </a></li>
<?php } endforeach; } } ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<?php endif; wp_reset_postdata(); ?>
<?php } else{ ?>
<?php $current_post_id = $post->ID; $pppr=ot_get_option('pppf'); $terms = get_the_terms( $current_post_id, 'singer' ); $term_ids = is_array( $terms ) ? wp_list_pluck( $terms, 'term_id' ) : array();
$second_query = new WP_Query( array('post_type'=>'post',
'tax_query' => array( array('taxonomy'=>'singer','field'=>'term_id','terms'=>$term_ids,'operator'=>'IN')),
'posts_per_page'=>$pppr,'ignore_sticky_posts'=>1,'orderby'=>'id'));
if($second_query->have_posts()) { ?>	
<div class="related_posts rel_sing_bbt">
<div class="title_tarlanweb_box">
<h3 class="tarlanweb_side_titles">سایر آهنگهای <?php $term_obj_list = get_the_terms( $current_post_id, 'singer' );
$term_names = is_array( $term_obj_list ) ? wp_list_pluck( $term_obj_list, 'name' ) : array();
$terms_string = implode( ' , ', $term_names ); echo esc_html( $terms_string ); ?></h3>
<?php $terms = get_the_terms( $current_post_id, 'singer' ); if ( is_array( $terms ) ) { foreach ( $terms as $term ) { ?>
<div class="left_artists_pp"><a class="artist_songs_page" href="<?php echo esc_url( get_term_link( $term ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی <?php echo esc_html( $term->name ); ?> </a></div>
<?php } } ?>
<div class="liner clear"></div>
</div>
<div class="tarlanweb_side_box">
<ul>
<?php while($second_query->have_posts()) : $second_query->the_post(); ?>
<li<?php if($current_post_id === $post->ID){ ?> class="inactive_songs"<?php } ?>><a href="<?php the_permalink(); ?>">
<div class="img_rkianoosh_box"><?php if($current_post_id === $post->ID){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?>
<?php if($current_post_id === $post->ID){ ?><div class="nowPlayingIcon"><span></span><span></span><span></span><span></span></div><?php } ?></div>
<?php $related_artist = get_post_meta( get_the_ID(), 'artist', true ); $related_track = get_post_meta( get_the_ID(), 'song', true );
if ( ! empty( $related_artist ) ) { ?> <span class="song_artists"> <?php echo esc_html( $related_artist ); ?> </span> <span> <?php echo esc_html( $related_track ); ?> </span> <?php } else { echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?> 
<?php $terms = get_the_terms( $current_post_id, 'singer' ); if ( is_array( $terms ) ) { foreach ( $terms as $term ) { ?>
<li class="artist_songs_page_li mobile_more_artist"><a class="artist_songs_page" href="<?php echo esc_url( get_term_link( $term ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی <?php echo esc_html( $term->name ); ?> </a></li>
<?php } } ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>	
<?php } ?>
<?php wp_reset_postdata(); ?>
<?php } } ?>

<?php $cm_off = ot_get_option('cm_off'); if('off' != $cm_off){ ?>
<div class="single_posts rkianoosh_comment_box">
<h3 class="comm_titrs">نظر خود را بنویسید</h3>
<?php comments_template(); ?>
<div class="clear"></div>
</div>
<?php } ?>

<div class="clear"></div>
</div>
<!-- single_posts_right -->
	
<div id="left_side">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('left_side')) : endif; ?>
<?php $reltag1 = ot_get_option('reltag1'); if('off' == $reltag1){
$reltag = ot_get_option('reltag'); if('off' != $reltag){ ?>	
<?php $current_post_id = $post->ID; $pppr=ot_get_option('pppf'); $artist=get_field('artist');
$my_custom_query= new WP_Query(
array('post_type'=>'post','post_status'=>'publish','posts_per_page'=> $pppr,
'meta_query'=>array(array('key'=>'artist','value'=>$artist,'compare'=>'LIKE')), ));
if($my_custom_query->have_posts()) : ?>
<aside class="related_posts">
<h3 class="tarlanweb_side_titles">سایر آهنگهای <?php echo esc_html( $artist ); ?></h3>
<div class="liner clear"></div>
<div class="tarlanweb_side_box">
<ul>
<?php while($my_custom_query->have_posts()) : $my_custom_query->the_post(); ?>
<li<?php if($current_post_id === $post->ID){ ?> class="inactive_songs"<?php } ?>><a href="<?php the_permalink(); ?>">
<div class="img_rkianoosh_box"><?php if($current_post_id === $post->ID){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?>
<?php if($current_post_id === $post->ID){ ?><div class="nowPlayingIcon"><span></span><span></span><span></span><span></span></div><?php } ?></div>
<?php $related_artist = get_post_meta( get_the_ID(), 'artist', true ); $related_track = get_post_meta( get_the_ID(), 'song', true );
if ( ! empty( $related_artist ) ) { ?> <span class="song_artists"> <?php echo esc_html( $related_artist ); ?> </span> <span> <?php echo esc_html( $related_track ); ?> </span> <?php } else { echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?>
<?php if(has_tag( '', $current_post_id ) ){ if(isset($artist) && !empty($artist)){ $post_tags = get_the_tags( $current_post_id ); foreach( $post_tags as $tag) :
if ( $tag->name === $artist ){ ?>
<li class="artist_songs_page_li"><a class="artist_songs_page" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی  <?php echo esc_html( $tag->name ); ?> </a></li>
<?php } endforeach; } } ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</aside>
<?php endif; wp_reset_postdata(); ?>
<?php } else{ ?>
<?php $current_post_id = $post->ID; $pppr=ot_get_option('pppf'); $terms = get_the_terms( $current_post_id, 'singer' ); $term_ids = is_array( $terms ) ? wp_list_pluck( $terms, 'term_id' ) : array();
$second_query = new WP_Query( array('post_type'=>'post',
'tax_query' => array( array('taxonomy'=>'singer','field'=>'term_id','terms'=>$term_ids,'operator'=>'IN')),
'posts_per_page'=>$pppr,'ignore_sticky_posts'=>1,'orderby'=>'id'));
if($second_query->have_posts()) { ?>	
<aside class="related_posts">
<div class="title_tarlanweb_box">
<h3 class="tarlanweb_side_titles">سایر آهنگهای <?php $term_obj_list = get_the_terms( $current_post_id, 'singer' );
$term_names = is_array( $term_obj_list ) ? wp_list_pluck( $term_obj_list, 'name' ) : array();
$terms_string = implode( ' , ', $term_names ); echo esc_html( $terms_string ); ?></h3>
<div class="liner clear"></div>
</div>
<div class="tarlanweb_side_box">
<ul>
<?php while($second_query->have_posts()) : $second_query->the_post(); ?>
<li<?php if($current_post_id === $post->ID){ ?> class="inactive_songs"<?php } ?>><a href="<?php the_permalink(); ?>">
<div class="img_rkianoosh_box"><?php if($current_post_id === $post->ID){ ?><i class="inactive_box_cir"></i><?php } ?>
<?php if(has_post_thumbnail()){
the_post_thumbnail('thumb3',array('alt'=>''.get_the_title(),'title'=>''.get_the_title().'')); } else { ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ); ?>" width="60" height="60" alt="تصویر پیدا نشد" title="تصویر پیدا نشد"><?php } ?>
<?php if($current_post_id === $post->ID){ ?><div class="nowPlayingIcon"><span></span><span></span><span></span><span></span></div><?php } ?></div>
<?php $related_artist = get_post_meta( get_the_ID(), 'artist', true ); $related_track = get_post_meta( get_the_ID(), 'song', true );
if ( ! empty( $related_artist ) ) { ?> <span class="song_artists"> <?php echo esc_html( $related_artist ); ?> </span> <span> <?php echo esc_html( $related_track ); ?> </span> <?php } else { echo esc_html( get_the_title() ); } ?>	
</a></li>
<?php endwhile; ?>
<?php $terms = get_the_terms( $current_post_id, 'singer' ); if ( is_array( $terms ) ) { foreach ( $terms as $term ) { ?>
<li class="artist_songs_page_li"><a class="artist_songs_page" href="<?php echo esc_url( get_term_link( $term ) ); ?>"> <i class="icofont-radio-mic"></i> صفحه اختصاصی <?php echo esc_html( $term->name ); ?> </a></li>
<?php } } ?>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
</aside>	
<?php } ?>
<?php wp_reset_postdata(); ?>
<?php }
	} ?>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('left_side2')) : endif; ?>
<div class="clear"></div>
</div>	

<div class="clear"></div>
</div>
</div>
<!-- centers_box -->

<?php get_footer(''); ?>