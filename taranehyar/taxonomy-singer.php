<?php
/**
 * آرشیو خواننده (taxonomy-singer.php)
 *
 * چرا این فایل بازنویسی شد؟
 * نسخهٔ قبلی سه کوئری جدا با meta_query روی musics_type = mp3 / mp4 / album می‌زد.
 * اگر مقدار ذخیره‌شدهٔ آن فیلد در سایت شما چیز دیگری باشد (مثلاً برچسب ACF، حروف
 * بزرگ، «آهنگ»/«آلبوم»، یا کلید متفاوت)، هر سه بخش خالی می‌شدند و صفحهٔ خواننده
 * عملاً هیچ آهنگی نشان نمی‌داد.
 *
 * نسخهٔ جدید:
 *   • فقط یک کوئری می‌زند و نتایج را در PHP دسته‌بندی می‌کند (سریع‌تر از سه کوئری).
 *   • مقدار musics_type را نرمال می‌کند و مترادف‌های رایج را می‌فهمد؛ هر مقداری که
 *     ناشناخته باشد در بخش «سایر موارد» نمایش داده می‌شود، پس هیچ نوشته‌ای پنهان نمی‌ماند.
 *   • اگر هنوز چیزی برای نمایش نباشد، پیام روشن + لینک فهرست هنرمندان نشان می‌دهد
 *     (قبلاً صفحه کاملاً خالی به‌نظر می‌رسید).
 *   • Counts بالای صفحه از همان دسته‌بندی می‌آید تا با بخش‌های پایین هم‌خوان باشد.
 *
 * قابل تنظیم با فیلترها:
 *   javanseda_artist_type_map     نگاشت مقادیر musics_type به دسته‌ها
 *   javanseda_artist_posts_limit  سقف تعداد نوشته‌های خواننده (پیش‌فرض -۱ = همه)
 */

get_header();
get_template_part( 'inc/breadcrumbs' );

$taranehyar_term = get_queried_object();

if ( ! $taranehyar_term instanceof WP_Term ) {
	// تاکسونومی/ترم به‌درستی بارگذاری نشده است؛ به‌جای صفحهٔ خالی، پیام روشن بده.
	?>
	<div class="tarlanweb_center">
		<div class="artist_box_tarlanweb">
			<div class="artist_box_detss">
				<h1 class="artist_name_head">صفحهٔ این خواننده در دسترس نیست</h1>
				<div class="artist_txt_box">
					<p>آدرس این صفحه با هیچ هنرمند ثبت‌شده‌ای مطابقت ندارد. اگر قبلاً این صفحه کار می‌کرد، احتمالاً قوانین پیوند یکتا (Permalink) نیاز به بازسازی دارد: پیشخوان ← تنظیمات ← پیوندهای یکتا ← ذخیرهٔ تغییرات.</p>
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">بازگشت به صفحهٔ اصلی</a></p>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php
	get_footer();
	return;
}

$taranehyar_term_field = function ( $key ) use ( $taranehyar_term ) {
	return function_exists( 'get_field' ) ? get_field( $key, $taranehyar_term ) : '';
};

$taranehyar_image     = $taranehyar_term_field( 'aimg2' );
$taranehyar_image_url = '';
if ( is_array( $taranehyar_image ) && isset( $taranehyar_image['url'] ) ) {
	$taranehyar_image_url = $taranehyar_image['url'];
} elseif ( is_string( $taranehyar_image ) ) {
	$taranehyar_image_url = $taranehyar_image;
}

$taranehyar_socials = array(
	'afacebook'  => 'facebook',
	'atelegram'  => 'telegram',
	'ainstagram' => 'instagram',
	'atwitter'   => 'twitter',
	'ayoutube'   => 'youtube',
);

/* ------------------------------------------------------------------
   نگاشت نوع محتوا: هر مقدار ناشناخته در «سایر موارد» می‌افتد (پنهان نمی‌شود)
------------------------------------------------------------------- */
$taranehyar_type_map = apply_filters(
	'javanseda_artist_type_map',
	array(
		/* صوتی */
		'mp3'            => 'audio',
		'audio'          => 'audio',
		'ahang'          => 'audio',
		'آهنگ'           => 'audio',
		'آهنگ جدید'      => 'audio',
		'song'           => 'audio',
		/* تصویری */
		'mp4'            => 'video',
		'video'          => 'video',
		'musicvideo'     => 'video',
		'music-video'    => 'video',
		'موزیک ویدیو'    => 'video',
		'موزیک‌ویدیو'    => 'video',
		'کلیپ'           => 'video',
		/* آلبوم */
		'album'          => 'album',
		'آلبوم'          => 'album',
	)
);

$taranehyar_labels = apply_filters(
	'javanseda_artist_type_labels',
	array(
		'album' => 'آلبوم ها',
		'audio' => 'آهنگ ها',
		'video' => 'موزیک ویدیو ها',
		'other' => 'سایر موارد',
	)
);

$taranehyar_limit = (int) apply_filters( 'javanseda_artist_posts_limit', -1 );

$taranehyar_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $taranehyar_limit,
		'orderby'             => 'date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
		'tax_query'           => array(
			array(
				'taxonomy' => 'singer',
				'field'    => 'slug',
				'terms'    => $taranehyar_term->slug,
				'operator' => 'IN',
			),
		),
	)
);

$taranehyar_buckets  = array( 'album' => array(), 'audio' => array(), 'video' => array(), 'other' => array() );
$taranehyar_found    = 0;
$taranehyar_unknown  = array();

if ( $taranehyar_query->have_posts() ) {
	$taranehyar_found = (int) $taranehyar_query->found_posts;
	foreach ( $taranehyar_query->posts as $taranehyar_post ) {
		$taranehyar_raw = get_post_meta( $taranehyar_post->ID, 'musics_type', true );
		if ( ! is_scalar( $taranehyar_raw ) ) {
			$taranehyar_raw = '';
		}
		$taranehyar_key = strtolower( trim( (string) $taranehyar_raw ) );
		if ( isset( $taranehyar_type_map[ $taranehyar_key ] ) ) {
			$taranehyar_bucket = $taranehyar_type_map[ $taranehyar_key ];
		} elseif ( isset( $taranehyar_type_map[ (string) $taranehyar_raw ] ) ) {
			$taranehyar_bucket = $taranehyar_type_map[ (string) $taranehyar_raw ];
		} else {
			$taranehyar_bucket = 'other';
			if ( '' !== $taranehyar_key ) {
				$taranehyar_unknown[ $taranehyar_key ] = true;
			}
		}
		$taranehyar_buckets[ $taranehyar_bucket ][] = $taranehyar_post;
	}
}
wp_reset_postdata();
?>

<div class="tarlanweb_center">
	<div class="artist_box_tarlanweb">
		<div class="artists_imsf">
			<?php if ( '' !== $taranehyar_image_url ) : ?>
				<img src="<?php echo esc_url( $taranehyar_image_url ); ?>" width="200" height="200" alt="<?php echo esc_attr( $taranehyar_term->name ); ?>" title="<?php echo esc_attr( $taranehyar_term->name ); ?>">
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/images/def-singer.webp' ); ?>" width="200" height="200" alt="<?php echo esc_attr( $taranehyar_term->name ); ?>" title="<?php echo esc_attr( $taranehyar_term->name ); ?>">
			<?php endif; ?>
			<div class="socials_box">
				<span>صفحات مجازی هنرمند</span>
				<?php foreach ( $taranehyar_socials as $taranehyar_field_key => $taranehyar_network ) : ?>
					<?php $taranehyar_social_url = $taranehyar_term_field( $taranehyar_field_key ); ?>
					<?php if ( ! empty( $taranehyar_social_url ) ) : ?>
						<a href="<?php echo esc_url( $taranehyar_social_url ); ?>" class="icofont-<?php echo esc_attr( 'telegram' === $taranehyar_network ? 'paper-plane' : ( 'youtube' === $taranehyar_network ? 'youtube-play' : $taranehyar_network ) ); ?>" aria-label="<?php echo esc_attr( $taranehyar_network ); ?>"></a>
					<?php endif; ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="artist_box_detss">
			<h1 class="artist_name_head">دانلود آهنگ‌های <?php echo esc_html( $taranehyar_term->name ); ?></h1>
			<ul class="artist_resume_box">
				<?php foreach ( array( 'album', 'audio', 'video', 'other' ) as $taranehyar_key ) : ?>
					<?php $taranehyar_count = count( $taranehyar_buckets[ $taranehyar_key ] ); ?>
					<?php if ( $taranehyar_count > 0 ) : ?>
						<li><?php echo absint( $taranehyar_count ); ?> <?php echo esc_html( isset( $taranehyar_labels[ $taranehyar_key ] ) ? $taranehyar_labels[ $taranehyar_key ] : $taranehyar_key ); ?></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<div class="clear2"></div>
			<?php
			$taranehyar_description = get_the_archive_description();
			if ( ! empty( $taranehyar_description ) ) :
				?>
				<div class="artist_txt_box">
					<?php echo wp_kses_post( $taranehyar_description ); ?>
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

<?php foreach ( array( 'album', 'audio', 'video', 'other' ) as $taranehyar_key ) : ?>
	<?php if ( empty( $taranehyar_buckets[ $taranehyar_key ] ) ) : ?>
		<?php continue; ?>
	<?php endif; ?>
	<!-- song_boxs -->
	<div class="song_boxs">
		<div class="songs_title_box">
			<h3><?php echo esc_html( isset( $taranehyar_labels[ $taranehyar_key ] ) ? $taranehyar_labels[ $taranehyar_key ] : $taranehyar_key ); ?></h3>
			<div class="clear"></div><div class="liner"></div>
		</div>
		<div class="song_boxs_posts">
			<ul>
				<?php
				foreach ( $taranehyar_buckets[ $taranehyar_key ] as $taranehyar_post ) :
					$GLOBALS['post'] = $taranehyar_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- لازم برای جزئی که به حلقهٔ اصلی تکیه دارد
					setup_postdata( $taranehyar_post );
					?>
					<li><?php get_template_part( 'inc/songs_post' ); ?></li>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- song_boxs -->
<?php endforeach; ?>

<?php if ( 0 === $taranehyar_found ) : ?>
	<div class="song_boxs">
		<div class="songs_title_box">
			<h3>آهنگی برای این خواننده ثبت نشده است</h3>
			<div class="clear"></div><div class="liner"></div>
		</div>
		<div class="artist_txt_box">
			<p>هنوز نوشته‌ای به این خواننده متصل نشده است. اگر آهنگ‌های این خواننده در سایت موجودند، در نوشته‌ها فیلد «خواننده» را به همین نام انتخاب کنید.</p>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">بازگشت به صفحهٔ اصلی</a></p>
			<div class="clear"></div>
		</div>
	</div>
<?php elseif ( ! empty( $taranehyar_unknown ) ) : ?>
	<?php /* مقادیر ناشناخته در «سایر موارد» نمایش داده شده‌اند؛ برای تشخیص سریع، نام‌شان در کد می‌ماند. */ ?>
	<!-- musics_type values seen: <?php echo esc_html( implode( ', ', array_keys( $taranehyar_unknown ) ) ); ?> -->
<?php endif; ?>

<div class="clear"></div>
</div>
</div>
<!-- centers_box -->

</div>

<?php get_footer( '' ); ?>
