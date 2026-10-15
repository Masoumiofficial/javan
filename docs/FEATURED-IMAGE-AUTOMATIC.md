# نمایش خودکار تصویر شاخص در بخش توضیحات صفحهٔ آهنگ

**خلاصهٔ پاسخ:** فایل اصلی موردنیاز `taranehyar/single.php` است (صفحهٔ تک‌نوشته/آهنگ). اگر نمی‌خواهی به قالب دست بزنی، می‌توانی همین کار را با یک فیلتر در `taranehyar/myfunctions.php` انجام دهی. فایل `taranehyar/functions.php` با ionCube محافظت شده و محل مناسب تغییر نیست.

این تغییر انجام شده است: در `single.php` تصویر شاخص به‌صورت خودکار پیش از `the_content()` چاپ می‌شود، پس دیگر لازم نیست همان تصویر را دستی داخل متن توضیحات بگذاری.

---

## راه ۱ (اعمال‌شده) — تغییر در `single.php`

محل دقیق: داخل `div.single_content_box`، **قبل از** فراخوانی `the_content('')` (حدود خط ۳۱).

```php
<div class="single_content_box">

<?php
$taranehyar_featured_size = 'large'; // 'large' | 'full' | 'thumb1' (640×360) | 'thumb2' (190×190)
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
```

استایل مربوطه در `taranehyar/style.css` (قاعدهٔ سراسری `img{max-width:100%;height:auto}` از قبل وجود دارد):

```css
/* کاور وسط‌چین با گوشهٔ گرد ۱۶px و افکت زوم/درخشش — بلوک کامل در cover-post/README.md */
.single_featured_cover{margin: 0 0 22px 0;text-align: center;}
.single_featured_image{display: inline-block;position: relative;max-width: 880px;line-height: 0;
overflow: hidden;border-radius: 16px;vertical-align: top;
box-shadow: var(--ab-shadow);
animation: taranehyar_cover_in 0.55s ease-out both;}
.single_featured_image img{display: block;width: auto;height: auto;max-width: 100%;
border-radius: inherit;backface-visibility: hidden;
transition: transform 0.5s cubic-bezier(0.2,0.7,0.3,1),filter 0.5s ease;}
@keyframes taranehyar_cover_in{from{opacity: 0;transform: translateY(10px) scale(0.985);}to{opacity: 1;transform: none;}}
.single_featured_image:hover img{transform: scale(1.045);filter: saturate(1.05) brightness(1.02);}
.single_featured_image::after{content: "";position: absolute;top: -60%;left: -60%;width: 45%;height: 220%;
pointer-events: none;transform: rotate(20deg) translateX(-260%);
background: rgba(255,255,255,0.24);filter: blur(10px);}
.single_featured_image:hover::after{animation: taranehyar_cover_shine 0.85s cubic-bezier(0.2,0.7,0.3,1);}
@keyframes taranehyar_cover_shine{from{transform: rotate(20deg) translateX(-260%);}to{transform: rotate(20deg) translateX(560%);}}
.night .single_featured_image{box-shadow: 0 8px 22px rgba(0,0,0,0.5);}
@media (max-width: 767px){.single_featured_cover{margin-bottom: 16px;}.single_featured_image{border-radius: 12px;}}
@media (prefers-reduced-motion: reduce){
.single_featured_image,.single_featured_image img,.single_featured_image::after{animation: none !important;transition: none !important;}
.single_featured_image:hover img{transform: none;}
}
```

نکته: `post-thumbnails` قبلاً در `myfunctions.php` فعال شده است، پس شرط `has_post_thumbnail()` کار می‌کند.

## راه ۲ (اختیاری) — بدون دست‌زدن به قالب، با `myfunctions.php`

اگر می‌خواهی تصویر شاخص به‌صورت خودکار به محتوای همهٔ نوشته‌ها (هر قالبی که `the_content()` را صدا می‌زند) اضافه شود، این کد را انتهای `taranehyar/myfunctions.php` بگذار:

```php
<?php
function taranehyar_auto_featured_image_in_content( $content ) {
	if ( is_singular( 'post' ) && is_main_query() && in_the_loop() && has_post_thumbnail() ) {
		$image = '<div class="single_featured_cover"><figure class="single_featured_image">' . get_the_post_thumbnail(
			get_the_ID(),
			'large',
			array( 'alt' => get_the_title(), 'title' => get_the_title() )
		) . '</figure></div>';
		return $image . $content;
	}
	return $content;
}
add_filter( 'the_content', 'taranehyar_auto_featured_image_in_content', 20 );
```

> اگر راه ۲ را فعال می‌کنی، بلوک راه ۱ را از `single.php` حذف کن؛ در غیر این صورت تصویر دو بار نمایش داده می‌شود.

## چرا `functions.php` نه؟

`taranehyar/functions.php` با ionCube رمزگذاری شده و ویرایش آن کد/مجوز را نامعتبر می‌کند (پیش‌درآمد فایل در نبود Loader خطا چاپ می‌کند). هر کد سفارشی باید در فایل خوانا `myfunctions.php` یا در قالب‌ها قرار بگیرد.

## تنظیم‌های پرکاربرد

| خواسته | کار لازم |
|---|---|
| تصویر بزرگ‌تر/اصل | `$taranehyar_featured_size = 'full';` |
| تصویر مربعی ۱۹۰×۱۹۰ (هم‌اندازهٔ لیست‌ها) | `$taranehyar_featured_size = 'thumb2';` |
| تصویر ۱۶:۹ (۶۴۰×۳۶۰) | `$taranehyar_featured_size = 'thumb1';` |
| تصویر بعد از متن توضیحات بیاید | بلوک `has_post_thumbnail()` را به **بعد** از `the_content('')` منتقل کن |

| بدون افکت (فقط وسط‌چین و گرد) | بلوک «AFEKTS» را در `style.css` کامنت کن |
| کاور کوچک‌تر و وسط‌تر | در `.single_featured_image` مقدار `max-width: 880px` را کم کن (مثلاً `700px`) |
| گردی گوشه بیشتر | `border-radius: 16px` را به `20px` تغییر بده |
| کاور یکنواخت ۱۶:۹ | در `.single_featured_image img` این دو خط را اضافه کن: `aspect-ratio: 16 / 9;object-fit: cover;width: 100%;` |
| تغییر رنگ سایت | فقط متغیر `--ab-blue` را در `:root` بالای `style.css` عوض کن (پالت سازمانی، بخش ۲ سند `cover-post/README.md`) |
| تصویر داخل بلوک «متن آهنگ» (`music_text`) بیاید | بلوک را قبل از `<div class="music_textss">` بگذار |
| در برگه‌ها (`page.php`) هم بیاید | همان بلوک را قبل از `the_content('')` در `page.php` قرار بده |
| نمایش تصویر جای‌گزین `nomusics.jpg` وقتی تصویر شاخص ندارد | `$image` را در نبود تصویر با `<img src="'.esc_url( get_template_directory_uri() . '/images/nomusics.jpg' ).'">` بساز |

## نکات مهم

- نوشته‌های بدون تصویر شاخص هیچ چیز اضافه‌ای نمایش نمی‌دهند (جای‌گزین عمداً نمایش داده نمی‌شود).
- اگر تصویر را قبلاً داخل متن توضیحات گذاشته‌ای، بعد از این تغییر آن را از متن حذف کن تا دوبار تکرار نشود.
- `alt` و `title` از عنوان نوشته خوانده می‌شوند؛ برای متن جانشین اختصاصی می‌توانی از فیلد ACF خودت استفاده کنی.
- از آنجا که `myfunctions.php` اندازه‌های `thumb1..thumb4` را ثبت می‌کند، تصاویر آپلودشدهٔ قبلی هم این اندازه‌ها را دارند؛ نیازی به آپلود مجدد نیست.
- پیش‌نمایش زندهٔ ظاهر و افکت: `cover-post/preview/index.html` (یا پوشهٔ `cover-post/preview` را با یک وب‌سرور ساده باز کن).
- تست‌های انجام‌شده: تمام ۴۳ فایل PHP خوانا (به‌جز دو فایل محافظت‌شده) با `php-parser` بدون خطا parse شدند و بستهٔ آزمون بازسازی/بررسی CRC شد. اجرای واقعی روی وردپرس هنوز آزمایش نشده است.
