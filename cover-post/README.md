# سه فایل جایگزین — کاور پست (تصویر شاخص) وسط‌چین، گوشهٔ گرد، با افکت

این سه فایل، نسخهٔ اصلاح‌شدهٔ همان فایل‌های **اصلی قالب شما** (`javanseda` نسخهٔ ۳.۰، مطابق `javanseda.zip`) هستند. هیچ تغییر دیگری (نام قالب، رنگ‌بندی، Text Domain یا اصلاحات نسخهٔ TaranehYar) روی آن‌ها اعمال نشده است؛ فقط قابلیت خواسته‌شده اضافه شده تا جایگزینی بی‌خطر باشد.

فایل‌ها: `single.php` · `style.css` · `myfunctions.php`

**پیش‌نمایش زنده:** [`preview/index.html`](preview/index.html) — اگر همان پوشه را در مرورگر باز کنی، هم وسط‌چینی، هم گردی گوشه‌ها و هم هر دو افکت (زوم نرم + عبور درخشش) را می‌بینی.

---

## چه چیزی در هر فایل تغییر کرده؟

### ۱) `single.php` — تغییر اصلی
داخل `<div class="single_content_box">` و **قبل از** `<?php the_content(''); ?>`:

```php
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
```

- `div.single_featured_cover` فقط برای **وسط‌چین کردن** کاور است (چون متن قالب راست‌چین است و بدون این محفظه، تصویر می‌چسبد به کنار).
- `figure.single_featured_image` خودش دور تصویر می‌پیچد (shrink-to-fit)، پس سایه و گردی گوشه دقیقاً روی تصویر می‌افتد، نه روی یک کادر خالی.
- تصویر شاخص هر نوشته خودکار در ابتدای بخش توضیحات می‌آید؛ دیگر لازم نیست همان تصویر را دستی داخل متن توضیحات بگذاری.

### ۲) `style.css` — استایل، وسط‌چینی، گردی گوشه و افکت
بلافاصله بعد از خط `.single_content_box{position: relative;}` این بلوک اضافه شده است:

```css
.single_featured_cover{margin: 0 0 22px 0;text-align: center;}
.single_featured_image{display: inline-block;position: relative;max-width: 880px;line-height: 0;
overflow: hidden;border-radius: 16px;vertical-align: top;
box-shadow: 0 8px 22px rgba(28,76,156,0.14),0 2px 6px rgba(28,76,156,0.08);
animation: taranehyar_cover_in 0.55s ease-out both;}
.single_featured_image img{display: block;width: auto;height: auto;max-width: 100%;
border-radius: inherit;backface-visibility: hidden;
transition: transform 0.5s cubic-bezier(0.2,0.7,0.3,1),filter 0.5s ease;}
@keyframes taranehyar_cover_in{from{opacity: 0;transform: translateY(10px) scale(0.985);}to{opacity: 1;transform: none;}}
/* ----- AFEKTS: افکت ۱ = زوم نرم روی کاور | افکت ۲ = عبور درخشش مورب ----- */
.single_featured_image:hover img{transform: scale(1.045);filter: saturate(1.05) brightness(1.02);}
.single_featured_image::after{content: "";position: absolute;top: -60%;left: -60%;width: 45%;height: 220%;
pointer-events: none;transform: rotate(20deg) translateX(-260%);
background: linear-gradient(100deg,rgba(255,255,255,0) 0%,rgba(255,255,255,0.30) 50%,rgba(255,255,255,0) 100%);}
.single_featured_image:hover::after{animation: taranehyar_cover_shine 0.85s cubic-bezier(0.2,0.7,0.3,1);}
@keyframes taranehyar_cover_shine{from{transform: rotate(20deg) translateX(-260%);}to{transform: rotate(20deg) translateX(560%);}}
/* ----- پایان AFEKTS ----- */
.night .single_featured_image{box-shadow: 0 8px 22px rgba(0,0,0,0.5);}
@media (max-width: 767px){.single_featured_cover{margin-bottom: 16px;}.single_featured_image{border-radius: 12px;}}
@media (prefers-reduced-motion: reduce){
.single_featured_image,.single_featured_image img,.single_featured_image::after{animation: none !important;transition: none !important;}
.single_featured_image:hover img{transform: none;}
}
```

| افکت | توضیح |
|---|---|
| **وسط‌چینی** | کاور در وسط ستون محتوا می‌نشیند و حداکثر ۸۸۰ پیکسل عرض دارد؛ تصویرهای کوچک هم اندازهٔ خودشان و وسط‌چین نمایش داده می‌شوند (کشیده نمی‌شوند). |
| **گوشهٔ گرد** | `border-radius: 16px` روی خودِ تصویر و کادر آن (در موبایل ۱۲ پیکسل) — استاندارد و هماهنگ با `border-radius: 7px` کارت نوشته. |
| **سایهٔ ملایم** | سایهٔ دولایه با تُن آبی ملایم که با سایهٔ کارت نوشته هم‌خانواده است. |
| **افکت ۱ — زوم نرم** | با بردن موس روی کاور، تصویر حدود ۴.۵٪ زوم می‌شود و کمی شفاف‌تر/اشباع‌تر می‌شود؛ چون کادر `overflow: hidden` دارد، داخل همان گوشه‌های گرد بریده می‌شود. |
| **افکت ۲ — عبور درخشش** | یک نوار نور مورب روی کاور عبور می‌کند (فقط یک‌بار در هر هاور، بدون برگشت). |
| **ورود نرم** | با بارگذاری صفحه، کاور با محو + بالا آمدن خیلی ملایم ظاهر می‌شود. |
| **دسترس‌پذیری** | اگر کاربر «کاهش انیمیشن» را در سیستم فعال کرده باشد (`prefers-reduced-motion`)، همهٔ افکت‌ها خاموش می‌شوند. |
| **حالت شب** | در `body.night` سایه با تم تاریک هماهنگ می‌شود. |

### ۳) `myfunctions.php` — اختیاری و غیرفعال
در انتهای فایل یک بلوک اضافه شده که به‌صورت پیش‌فرض **خاموش** است و هیچ کاری نمی‌کند (فقط یک ثابت تعریف می‌کند):

```php
define( 'JAVANSEDA_COVER_IN_CONTENT', false ); // برای حالت سراسری: true
```

اگر `true` شود، فیلتر `the_content` کاور را خودکار به محتوای همهٔ نوشته‌ها اضافه می‌کند (بدون نیاز به دست‌زدن به قالب). در آن حالت باید بلوک تصویر شاخص را از `single.php` برداری، وگرنه تصویر دو بار نمایش داده می‌شود.

> `add_theme_support( 'post-thumbnails' )` و اندازه‌های `thumb1..thumb4` از قبل در همین فایل بودند؛ دست نخورده‌اند.

---

## نصب

1. از فایل‌ها و دیتابیس سایت بکاپ بگیر.
2. در مسیر `wp-content/themes/<پوشهٔ قالب فعلی>` سه فایل `single.php`، `style.css` و `myfunctions.php` را با همین سه فایل جایگزین کن (فایل‌منیجر هاست یا FTP).
3. کش افزونهٔ کش، CDN و مرورگر را پاک کن تا `style.css` تازه بارگذاری شود.
4. یک نوشتهٔ آهنگ را باز کن و با موس روی کاور برو.

## شخصی‌سازی سریع (همه در `style.css`)

| خواسته | تغییر |
|---|---|
| گردی گوشه بیشتر/کمتر | در `.single_featured_image` مقدار `border-radius: 16px` را عوض کن (مثلاً `20px` نرم‌تر، `10px` رسمی‌تر). |
| کاور کوچک‌تر و «وسط‌تر» | `max-width: 880px` را به `700px` (یا هر عدد دیگر) تغییر بده. |
| خاموش کردن افکت‌ها | دو قاعدهٔ زیر `/* ----- AFEKTS ... */` را کامنت کن (و `@keyframes taranehyar_cover_shine` را هم اگر خواستی). |
| بدون زوم، فقط درخشش | قاعدهٔ `.single_featured_image:hover img` را کامنت کن. |
| زوم بیشتر | `scale(1.045)` را مثلاً `scale(1.08)` کن. |
| بدون افکت ورود | `animation: taranehyar_cover_in ...` را از `.single_featured_image` بردار. |
| کاور هم‌اندازه و یکنواخت (۱۶:۹) | در `.single_featured_image img` این دو خط را اضافه کن: `aspect-ratio: 16 / 9;object-fit: cover;width: 100%;` — توجه: تصویرهای مربع بریده می‌شوند. |
| سایه سبک‌تر/بدون سایه | `box-shadow` را در `.single_featured_image` کم‌رنگ‌تر یا حذف کن. |
| کاور بعد از متن توضیحات | بلوک `has_post_thumbnail()` را در `single.php` به **بعد** از `the_content('')` منتقل کن. |
| در برگه‌ها (`page.php`) هم باشد | همان بلوک را در `page.php` قبل از `the_content('')` بگذار. |

## نکته‌ها

- نوشته‌های بدون تصویر شاخص هیچ چیز اضافه‌ای نمایش نمی‌دهند (جای‌گزین `nomusics.jpg` عمداً اینجا استفاده نشده است).
- اگر همان تصویر را قبلاً دستی داخل متن توضیحات گذاشته‌ای، از متن حذفش کن تا دو بار تکرار نشود.
- `alt` و `title` تصویر از عنوان نوشته خوانده می‌شود.
- افکت‌ها فقط CSS هستند؛ هیچ فایل JS اضافه‌ای لازم نیست و سرعت صفحه را پایین نمی‌آورند.
- این سه فایل روی وردپرس واقعی اجرا/آزمایش نشده‌اند (محیط PHP/WordPress در دسترس نیست)؛ فقط ساختار PHP و CSS آن‌ها بررسی شده است. قبل از اعمال روی سایت اصلی، روی staging امتحان کن.
