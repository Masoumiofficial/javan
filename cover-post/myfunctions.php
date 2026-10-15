<?php
add_theme_support( 'post-thumbnails' );
if (function_exists('add_image_size')){
add_image_size( 'thumb4', 150, 150, true);
add_image_size( 'thumb3', 60, 60, true);
add_image_size( 'thumb2', 190, 190, true);
add_image_size( 'thumb1', 640, 360, true);
} ?>
<?php
function shapeSpace_script_loader_tag($tag, $handle, $src) {
	if ($handle === 'my-plugin-javascript-handle') {
		if (false === stripos($tag, 'async')) {
			$tag = str_replace(' src', ' async="async" src', $tag);
		}
		if (false === stripos($tag, 'defer')) {
			$tag = str_replace('<script ', '<script defer ', $tag);
		}
	}
	return $tag;
}
add_filter('script_loader_tag', 'shapeSpace_script_loader_tag', 10, 3);
// end
function meks_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );
// end
?>
<?php
function leftsides(){
$args = array(
'id'            => 'left_side',
'class'         => 'leftside',
'name'          => 'ابزارک بالا ستون چپ سینگل',
'description'   => 'ابزارک بالا نوشته های مرتبط خواننده در ستون چپ سینگل را در این بخش قرار دهید.',
'before_widget' => '<aside class="related_posts %2$s">',
'before_title'  => '<h3 class="tarlanweb_side_titles">',
'after_title'   => '</h3><div class="liner clear"></div><div class="tarlanweb_side_box">',
'after_widget'  => '<div class="clear"></div></div></aside>',
);
register_sidebar($args);
}
add_action('widgets_init','leftsides');
function leftsides2(){
$args = array(
'id'            => 'left_side2',
'class'         => 'leftside2',
'name'          => 'ابزارک پایین ستون چپ سینگل',
'description'   => 'ابزارک پایین نوشته های مرتبط خواننده در ستون چپ سینگل را در این بخش قرار دهید.',
'before_widget' => '<aside class="related_posts %2$s">',
'before_title'  => '<h3 class="tarlanweb_side_titles">',
'after_title'   => '</h3><div class="liner clear"></div><div class="tarlanweb_side_box">',
'after_widget'  => '<div class="clear"></div></div></aside>',
);
register_sidebar($args);
}
add_action('widgets_init','leftsides2');
function leftsides1(){
$args = array(
'id'            => 'left_side1',
'class'         => 'leftside1',
'name'          => 'ابزارک ستون چپ برگه',
'description'   => 'ابزارک ستون چپ  برگه ها را در این بخش قرار دهید.',
'before_widget' => '<aside class="related_posts %2$s">',
'before_title'  => '<h3 class="tarlanweb_side_titles">',
'after_title'   => '</h3><div class="liner clear"></div><div class="tarlanweb_side_box">',
'after_widget'  => '<div class="clear"></div></div></aside>',
);
register_sidebar($args);
}
add_action('widgets_init','leftsides1');
?>
<?php add_action( 'template_redirect', function(){
ob_start( function( $buffer ){
$buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
$buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
$buffer = str_replace( array( 'frameborder="0"', "frameborder='0'" ), '', $buffer );
$buffer = str_replace( array( 'scrolling="no"', "scrolling='no'" ), '', $buffer );
return $buffer;
});
}); ?>
<?php add_filter('acf/settings/remove_wp_meta_box', '__return_false'); ?>
<?php function comment_loop_cd( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>بازتاب: <?php comment_author_link(); ?><?php edit_comment_link( 'ویرایش', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<article id="comment-<?php comment_ID(); ?>" class="comment">
<div class="comment-content"> 
<footer>
<?php printf( '%1$s',sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
esc_url( get_comment_link( $comment->comment_ID ) ),get_comment_time( 'c' ),
sprintf( '%1$s ، %2$s', get_comment_date("d M Y"), get_comment_time() ))); ?>
<div class="left_kianoosh_like"><div class="comment-date"><?php $d="d F y"; $comment_date = get_comment_date($d,''); echo $comment_date; ?></div>
<div class="clear"></div>
</div>
<div class="comment-replay">
<?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?>
</div>
<div class="clear"></div>
</footer>
<div class="clear"></div>
<div class="rkianoosh_ir_com">
<?php edit_comment_link( '(ویرایش)', '<span class="edit-link">', '</span>' ); ?>
<?php comment_text(); ?>
<?php if ( $comment->comment_approved == '0' ) : ?>
<em class="comment-awaiting-moderation">نظر شما بعد از تائید نمایش داده میشود.</em>
<br>
<?php endif; ?>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</article><!-- #comment-## -->
<?php
	break;
	endswitch;
}
function comment_form_cd( $args = array(), $post_id = null ) {
	global $id;
	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = ! empty( $user->ID ) ? $user->display_name : '';
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$fields =  array(
		'author' => '<div class="right-commentss"><p class="comment-form-author">' . '<input id="author" class="meta" name="author" type="text" placeholder="نام ( مورد نیاز )" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><input id="email" class="meta" name="email" type="text" placeholder="پست الکترونیکی (مورد نیاز)" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url">' . '<input id="url" class="meta" name="url" type="text" placeholder="وب سایت" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
	);
	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="11" aria-required="true" placeholder="نظرتان را بنویسید"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'شما باید <a href="%s">وارد شوید</a> برای ارسال دیدگاه' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'وارد شده با نام <a href="%1$s">%2$s</a>. <a href="%3$s" title="بیرون رفتن از حساب کاربری">بیرون رفتن؟</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( '' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => 'ارسال دیدگاه',
	);
	//'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
?>
<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
<div id="respond">
<h3 id="reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
<?php do_action( 'comment_form_top' ); ?>
<?php if ( is_user_logged_in() ) : ?>
<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
<?php else : ?>
<?php echo $args['comment_notes_before']; ?>
<?php
	do_action( 'comment_form_before_fields' );
	foreach ( (array) $args['fields'] as $name => $field ) {
	echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
}
do_action( 'comment_form_after_fields' ); ?>
<?php endif; ?>
<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
<?php // echo $args['comment_notes_after']; ?>
<p class="form-submit">
<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
<?php comment_id_fields( $post_id ); ?>
</p>
<?php do_action( 'comment_form', $post_id ); ?>
</form>
<?php endif; ?>
<div class="clear"></div>
</div><!-- #respond -->
<?php do_action( 'comment_form_after' ); ?>
<?php else : ?>
<?php do_action( 'comment_form_comments_closed' ); ?>
<?php endif; ?>
<?php
}
?>

<?php
/* ---------------------------------------------------------------------------
   «کاور پست» = تصویر شاخص نوشته (Featured Image)
   فعال بودن تصویر شاخص (post-thumbnails) و اندازه‌های thumb1..thumb4 در بالای
   همین فایل ثبت شده است و نیازی به تغییر ندارند.

   به‌صورت پیش‌فرض، نمایش خودکار کاور در ابتدای بخش توضیحات توسط قالب
   single.php انجام می‌شود و کد پایین غیرفعال است.

   حالت اختیاری (سراسری): اگر می‌خواهید کاور خودکار به محتوای نوشته‌ها اضافه شود
   و لازم نباشد به قالب دست بزنید، فقط مقدار ثابت زیر را به true تغییر دهید
   و در آن صورت بلوک تصویر شاخص را از single.php بردارید
   (در غیر این صورت تصویر دو بار نمایش داده می‌شود).
--------------------------------------------------------------------------- */

if ( ! defined( 'JAVANSEDA_COVER_IN_CONTENT' ) ) {
	define( 'JAVANSEDA_COVER_IN_CONTENT', false ); // for global mode change to: true
}

if ( JAVANSEDA_COVER_IN_CONTENT ) {
	function javanseda_content_auto_cover( $content ) {
		if ( is_singular( 'post' ) && is_main_query() && in_the_loop() && has_post_thumbnail() ) {
			$cover = '<div class="single_featured_cover"><figure class="single_featured_image">' . get_the_post_thumbnail(
				get_the_ID(),
				'large',
				array( 'alt' => get_the_title(), 'title' => get_the_title() )
			) . '</figure></div>';
			return $cover . $content;
		}
		return $content;
	}
	add_filter( 'the_content', 'javanseda_content_auto_cover', 20 );
}
?>


<?php
/* ==================================================================================
   شبکهٔ ایمنی «صفحهٔ خواننده» (تاکسونومی singer)
   ----------------------------------------------------------------------------------
   مشکل گزارش‌شده: صفحهٔ /singer/... دیگر نمایش داده نمی‌شود.
   این تاکسونومی در فایل رمزگذاری‌شدهٔ functions.php ثبت می‌شود، پس اگر آن ثبت انجام
   نشود (یا با تنظیمات غیرعمومی ثبت شده باشد) آدرس‌های /singer/... خطای ۴۰۴ می‌دهند.
   این بلوک بدون دست‌زدن به رفتار قالب، سه چیز را تضمین می‌کند:

     ۱) اگر تاکسونومی singer ثبت نشده باشد، همان را با تنظیمات درست ثبت می‌کند.
     ۲) اگر ثبت شده ولی عمومی/قابل‌کوئری نباشد، همان دو ویژگی را روشن می‌کند.
     ۳) یک‌بار قوانین پیوند یکتا (rewrite) را بازسازی می‌کند تا آدرس‌های قدیمی ۴۰۴ نشوند.

   خاموش کردن: ثابت زیر را true کنید.
   تشخیص: با حساب مدیر وارد شوید و آدرس زیر را باز کنید:
          ?ab_singer_diag=1                 گزارش کلی
          ?ab_singer_diag=1&ab_singer_term=mohsen-yeganeh   گزارش یک خواننده
   ================================================================================== */

if ( ! defined( 'JAVANSEDA_SINGER_FIX_OFF' ) ) {
	define( 'JAVANSEDA_SINGER_FIX_OFF', false );
}

if ( ! JAVANSEDA_SINGER_FIX_OFF ) {

	/* ۱) ثبت جایگزین تاکسونومی — فقط اگر واقعاً ثبت نشده باشد */
	add_action(
		'init',
		function () {
			if ( taxonomy_exists( 'singer' ) ) {
				return;
			}
			register_taxonomy(
				'singer',
				array( 'post' ),
				array(
					'labels'             => array(
						'name'          => 'خواننده‌ها',
						'singular_name' => 'خواننده',
						'menu_name'     => 'خواننده‌ها',
					),
					'public'             => true,
					'publicly_queryable' => true,
					'hierarchical'       => false,
					'show_ui'            => true,
					'show_admin_column'  => true,
					'show_in_rest'       => true,
					'rewrite'            => array(
						'slug'       => 'singer',
						'with_front' => false,
					),
				)
			);
		},
		5
	);

	/* ۲) اگر تاکسونومی هست ولی پنهان/غیرقابل‌کوئری است، درستش کن (بدون تغییر اسلاگ دلخواه) */
	add_filter(
		'register_taxonomy_args',
		function ( $args, $taxonomy ) {
			if ( 'singer' !== $taxonomy ) {
				return $args;
			}
			if ( empty( $args['public'] ) ) {
				$args['public'] = true;
			}
			if ( empty( $args['publicly_queryable'] ) ) {
				$args['publicly_queryable'] = true;
			}
			if ( empty( $args['rewrite'] ) ) {
				$args['rewrite'] = array(
					'slug'       => 'singer',
					'with_front' => false,
				);
			}
			return $args;
		},
		10,
		2
	);

	/* ۳) بازسازی یک‌بارهٔ قوانین پیوند یکتا (فقط وقتی خودِ تاکسونومی موجود است) */
	add_action(
		'admin_init',
		function () {
			if ( ! taxonomy_exists( 'singer' ) ) {
				return;
			}
			$version = '1.0.0';
			if ( get_option( 'javanseda_singer_rewrite_version' ) === $version ) {
				return;
			}
			flush_rewrite_rules( false ); // بازسازی نرم؛ فایل .htaccess دست‌کاری نمی‌شود
			update_option( 'javanseda_singer_rewrite_version', $version );
		}
	);

	/* ۴) گزارش تشخیصی مخصوص مدیر */
	add_action(
		'template_redirect',
		function () {
			if ( empty( $_GET['ab_singer_diag'] ) || ! current_user_can( 'manage_options' ) ) {
				return;
			}

			nocache_headers();
			header( 'Content-Type: text/plain; charset=utf-8' );

			$lines   = array();
			$lines[] = '=== Javanseda / TaranehYar — گزارش تشخیص صفحهٔ خواننده ===';
			$lines[] = 'WordPress: ' . get_bloginfo( 'version' ) . ' | PHP: ' . PHP_VERSION;
			$lines[] = 'Theme: ' . wp_get_theme()->get( 'Name' ) . ' ' . wp_get_theme()->get( 'Version' );
			$lines[] = 'home_url: ' . home_url( '/' ) . ' | permalink: ' . (string) get_option( 'permalink_structure' );
			$lines[] = '';

			$exists  = taxonomy_exists( 'singer' );
			$lines[] = 'taxonomy_exists(singer): ' . ( $exists ? 'YES' : 'NO  <-- علت ۴۰۴ شدن آدرس‌ها' );

			if ( $exists ) {
				$object = get_taxonomy( 'singer' );
				$lines[] = 'public: ' . ( $object->public ? 'yes' : 'NO' ) . ' | publicly_queryable: ' . ( $object->publicly_queryable ? 'yes' : 'NO' );
				$lines[] = 'hierarchical: ' . ( $object->hierarchical ? 'yes' : 'no' ) . ' | show_in_rest: ' . ( $object->show_in_rest ? 'yes' : 'no' );
				$lines[] = 'rewrite: ' . wp_json_encode( $object->rewrite, JSON_UNESCAPED_UNICODE );
				$lines[] = 'object_type: ' . wp_json_encode( $object->object_type );
				$lines[] = 'rewrite slug موجود در قوانین: ' . ( get_option( 'permalink_structure' ) ? 'بله' : 'ساختار ساده' );
			}

			$lines[]  = '';
			$lines[]  = 'تاکسونومی‌های ثبت‌شده: ' . implode( ', ', array_keys( get_taxonomies( array(), 'names' ) ) );
			$all      = get_terms( array( 'taxonomy' => 'singer', 'hide_empty' => false, 'number' => 5 ) );
			$total    = wp_count_terms( array( 'taxonomy' => 'singer', 'hide_empty' => false ) );
			$lines[]  = 'تعداد ترم‌های singer: ' . ( is_wp_error( $total ) ? 'WP_Error: ' . $total->get_error_message() : $total );
			if ( is_wp_error( $all ) ) {
				$lines[] = 'get_terms خطا: ' . $all->get_error_message();
			} elseif ( is_array( $all ) ) {
				$lines[] = 'نمونه ترم‌ها:';
				foreach ( $all as $sample ) {
					$link    = get_term_link( $sample );
					$lines[] = '   - ' . $sample->name . ' | slug: ' . $sample->slug . ' | count: ' . $sample->count . ' | ' . ( is_wp_error( $link ) ? 'لینک خطا: ' . $link->get_error_message() : $link );
				}
			}

			$needle = isset( $_GET['ab_singer_term'] ) ? sanitize_text_field( wp_unslash( $_GET['ab_singer_term'] ) ) : '';
			if ( '' !== $needle ) {
				$lines[] = '';
				$lines[] = '--- بررسی ترم: ' . $needle . ' ---';
				$term    = get_term_by( 'slug', sanitize_title( $needle ), 'singer' );
				if ( ! $term ) {
					$term = get_term_by( 'name', $needle, 'singer' );
				}
				if ( ! $term || is_wp_error( $term ) ) {
					$lines[] = 'ترمی با این اسلاگ/نام در singer پیدا نشد.';
					$tag     = get_term_by( 'name', $needle, 'post_tag' );
					if ( $tag && ! is_wp_error( $tag ) ) {
						$lines[] = 'اما برچسبی با همین نام وجود دارد: ' . get_term_link( $tag ) . ' (count: ' . $tag->count . ')';
						$lines[] = 'یعنی این سایت آرتیست‌ها را با «برچسب» نگه می‌دارد؛ برای آرشیو singer باید ترم ساخته شود یا نوشته‌ها به آن وصل شوند.';
					}
				} else {
					$link    = get_term_link( $term );
					$lines[] = 'term_id: ' . $term->term_id . ' | name: ' . $term->name . ' | slug: ' . $term->slug . ' | count: ' . $term->count;
					$lines[] = 'term_link: ' . ( is_wp_error( $link ) ? 'WP_Error: ' . $link->get_error_message() : $link );

					$histogram = array();
					$posts     = get_posts(
						array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => -1,
							'fields'         => 'ids',
							'tax_query'      => array(
								array(
									'taxonomy' => 'singer',
									'field'    => 'term_id',
									'terms'    => $term->term_id,
								),
							),
						)
					);
					$lines[] = 'تعداد نوشته‌های این ترم: ' . count( $posts );
					foreach ( $posts as $post_id ) {
						$raw = get_post_meta( $post_id, 'musics_type', true );
						$key = is_scalar( $raw ) ? (string) $raw : '';
						if ( '' === $key ) {
							$key = '(خالی)';
						}
						$histogram[ $key ] = isset( $histogram[ $key ] ) ? $histogram[ $key ] + 1 : 1;
					}
					$lines[] = 'پرتکرارترین مقدارهای musics_type: ' . ( $histogram ? wp_json_encode( $histogram, JSON_UNESCAPED_UNICODE ) : 'هیچ' );
				}
			}

			$lines[] = '';
			$lines[] = 'پایان گزارش.';
			echo esc_html( implode( "
", $lines ) ); // خروجی متنی ساده
			exit;
		},
		0
	);
}
