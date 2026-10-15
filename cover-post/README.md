# سه فایل جایگزین — کاور پست (وسط‌چین، گوشهٔ گرد، افکت) + باکس «متن ترانه»

این سه فایل، نسخهٔ اصلاح‌شدهٔ همان فایل‌های **اصلی قالب شما** (`javanseda` نسخهٔ ۳.۰، مطابق `javanseda.zip`) هستند. هیچ تغییر دیگری (نام قالب، رنگ‌بندی، Text Domain یا اصلاحات نسخهٔ TaranehYar) روی آن‌ها اعمال نشده است؛ فقط دو قابلیت خواسته‌شده اضافه شده تا جایگزینی بی‌خطر باشد.

این بسته **چهار فایل** دارد و سه موضوع را پوشش می‌دهد:

1. نمایش خودکار کاور پست (وسط‌چین، گوشهٔ گرد، افکت).
2. باکس «متن ترانه» + تیتر بخش دانلود با داده‌ساختاریافته.
3. **رفع مشکل نمایش‌داده‌نشدن صفحهٔ خواننده (`singer`)** — فایل `taxonomy-singer.php` + شبکهٔ ایمنی در `myfunctions.php`. تحلیل کامل: `docs/SINGER-ARCHIVE-DIAGNOSIS.md`.

قابلیت‌های این بسته:
1. **کاور پست** (تصویر شاخص) خودکار، وسط‌چین، با گوشهٔ گرد و افکت‌های CSS.
2. **باکس «متن ترانه»** جای `div.music_textss`: تیتر `متن آهنگ {song} از {artist}`، دکمهٔ کپی، لینک صفحهٔ خواننده روی تاکسونومی `singer`، حالت شب/موبایل و داده‌ساختاریافتهٔ `MusicRecording` + `MusicComposition`. آنالیز کامل: `docs/LYRICS-BOX-SEO-AIO.md`.
3. **تیتر بخش دانلود** (`<h2 class="dl_title">دانلود آهنگ {song} از {artist}</h2>`) و هم‌سان‌سازی ظاهری بخش دانلود.
4. همهٔ این بخش‌ها **وسط‌چین** و هم‌خانواده با هم شدند (هدر باکس ترانه، دکمه‌ها، متن ترانه، تیتر دانلود).

فایل‌ها: `single.php` · `style.css` · `myfunctions.php` · `taxonomy-singer.php`

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
box-shadow: var(--ab-shadow); /* 0 10px 26px rgba(17,17,17,.10),0 2px 8px rgba(17,17,17,.06) */
animation: taranehyar_cover_in 0.55s ease-out both;}
.single_featured_image img{display: block;width: auto;height: auto;max-width: 100%;
border-radius: inherit;backface-visibility: hidden;
transition: transform 0.5s cubic-bezier(0.2,0.7,0.3,1),filter 0.5s ease;}
@keyframes taranehyar_cover_in{from{opacity: 0;transform: translateY(10px) scale(0.985);}to{opacity: 1;transform: none;}}
/* ----- AFEKTS: افکت ۱ = زوم نرم روی کاور | افکت ۲ = عبور درخشش مورب ----- */
.single_featured_image:hover img{transform: scale(1.045);filter: saturate(1.05) brightness(1.02);}
.single_featured_image::after{content: "";position: absolute;top: -60%;left: -60%;width: 45%;height: 220%;
pointer-events: none;transform: rotate(20deg) translateX(-260%);
background: rgba(255,255,255,0.24);filter: blur(10px);} /* نوار درخشش تخت، بدون گرادینت */
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

## سیستم رنگ سازمانی (طراحی تخت، بدون گرادینت)

همهٔ رنگ‌های تأکیدی قالب (نارنجی `#ff8c00` و قرمز `#aa2712` نسخهٔ اصلی) به یک رنگ برند نگاشت شده‌اند و به‌صورت متغیر CSS در بالای `style.css` تعریف شده‌اند:

| نقش | کد | متغیر | کجا استفاده می‌شود |
|---|---|---|---|
| آبی آهنگ‌بان | `#185ADB` | `--ab-blue` | دکمه‌ها، لینک‌ها، ایکون‌ها، حاشیه‌های تأکیدی |
| آبی تیره (هاور) | `#1246AD` | `--ab-blue-dark` | حالت هاور دکمه‌های اصلی |
| آبی کم‌رنگ | `#EAF1FE` | `--ab-blue-soft` | هدر باکس ترانه، چیپ‌ها، دکمهٔ ثانویه |
| پس‌زمینهٔ صفحه | `#FFFFFF` | `--ab-page` | سفید ساده و استاندارد (به‌درخواست شما، آبی کم‌رنگ پس‌زمینه نشد) |
| مشکی | `#111111` | `--ab-ink` | پس‌زمینهٔ حالت شب، وضعیت «کپی شد» |
| زغالی | `#222222` | `--ab-charcoal` | کارت‌ها و هدر در حالت شب |
| سفید | `#FFFFFF` | `--ab-surface` / `--ab-white` | کارت‌ها و متن روی رنگ برند |

> «آبی کم‌رنگ» در پیام شما کد رنگ نداشت؛ من `#EAF1FE` را انتخاب کردم (نسخهٔ بسیار روشن همان `#185ADB`). اگر تُن دیگری می‌خواهید فقط همین یک متغیر `--ab-blue-soft` را در `:root` عوض کنید — کل سایت با آن هماهنگ می‌شود.

نکته‌ها:

- **بدون گرادینت:** همهٔ گرادینت‌ها با رنگ تخت جایگزین شدند (هدر باکس ترانه، آیکون‌های اینستاگرام، نوار درخشش کاور که حالا یک نوار تخت محو است).
- **یک رنگ برای همه‌چیز:** رنگ‌های برند شبکه‌های اجتماعی (فیس‌بوک/توییتر/واتس‌اپ/اینستاگرام) هم به آبی برند یکسان شدند. اگر ترجیح می‌دهید رنگ برند شبکه‌ها برگردد، فقط همان چند قاعدهٔ `:hover` را برگردانید.
- **حالت شب:** با بازنویسی همان متغیرها در `.night` انجام می‌شود (پس‌زمینه `#111111`، کارت `#222222`، و آبی متن‌ها به `#4C8BFF` روشن می‌شود تا روی زمینهٔ تیره خوانا بماند). به همین دلیل قواعد تکراری `.night .music_lyrics_*` حذف شدند و CSS سبک‌تر شد.
- **دسترس‌پذیری:** متن سفید روی `#185ADB` نسبت کنتراست ≈ ۵.۴:۱ دارد (در نسخهٔ قبلی، سفید روی نارنجی `#ff8c00` فقط ≈ ۲.۳:۱ بود) — یعنی این پالت هم خوانا‌تر است.
- **پس‌زمینه:** سفید سادهٔ استاندارد (`--ab-page: #FFFFFF`)؛ آبی کم‌رنگ فقط برای عناصر تأکیدی استفاده می‌شود. کارت‌ها با حاشیهٔ نازک `--ab-line` و سایهٔ خنثی `--ab-shadow` از پس‌زمینه جدا می‌شوند (سایه‌های آبی قدیمی هم خنثی شدند).
- **تغییر سراسری رنگ در آینده:** فقط `--ab-blue` را عوض کنید؛ نیازی به جست‌وجوی دستی ۴۹ مقدار رنگ در فایل نیست.

## این مرحله: باکس «متن ترانه» (متن آهنگ)

جای `div.music_textss` قبلی، یک بخش کامل با تیتر هدف‌دار، دکمهٔ کپی، لینک صفحهٔ خواننده و داده‌ساختاریافته نشسته است. آنالیز کامل UX/SEO/GEO/AIO در `docs/LYRICS-BOX-SEO-AIO.md` است.

```php
<?php
$taranehyar_lyrics_position = 'here'; // 'here' = بعد از توضیحات | 'end' = بعد از لینک‌های دانلود
$taranehyar_lyrics_schema   = true;   // چاپ JSON-LD (MusicRecording + MusicComposition)
$taranehyar_artist_type     = 'Person'; // 'MusicGroup' برای گروه/بند
?>
<section class="music_lyrics_box" aria-labelledby="taranehyar_lyrics_title" lang="fa" dir="rtl">
	<div class="music_lyrics_head">
		<h2 class="music_lyrics_title" id="taranehyar_lyrics_title">متن آهنگ {song} از {artist}</h2>
		<div class="music_lyrics_actions">
			<a class="music_lyrics_artist_link" href="…">سایر آهنگ‌های {artist}</a>
			<button type="button" class="music_lyrics_copy" id="taranehyar_lyrics_copy">کپی متن ترانه</button>
		</div>
	</div>
	<div class="music_lyrics_text" id="taranehyar_lyrics_text">…متن از فیلد music_text…</div>
</section>
```

| خواسته | تغییر |
|---|---|
| متن ترانه زیر لینک‌های دانلود بیاید | `$taranehyar_lyrics_position = 'end';` |
| بدون داده‌ساختاریافته | `$taranehyar_lyrics_schema = false;` |
| خواننده گروه/بند است | `$taranehyar_artist_type = 'MusicGroup';` |
| لینک دستی صفحهٔ خواننده | فیلد ACF اختیاری `artist_link` را روی نوشته پر کن (اولویت اول است) |
| بازنویسی برنامه‌ای لینک خواننده | فیلتر `taranehyar_artist_url` (نمونه در `docs/LYRICS-BOX-SEO-AIO.md`) |
| خاموش کردن تیتر «دانلود …» | `$taranehyar_download_title = false;` |
| متن ترانه راست‌چین شود | در `.music_lyrics_text` مقدار `text-align: center` → `right` |
| فونت/فاصلهٔ خط متفاوت | `font-size: 15px` و `line-height: 2.15` را در `.music_lyrics_text` عوض کن |
| گوشهٔ گرد بیشتر/کمتر | در `.music_lyrics_box` مقدار `border-radius: 12px` |
| حذف دکمهٔ کپی | مارک‌آپ `<button class="music_lyrics_copy">` و تگ `<script>` آخر باکس را حذف کن |
| نام آهنگ/خواننده از فیلدهای ACF | اگر فیلد شما `song`/`artist` نیست، در همان بلوک `get_field( 'song' )` و `get_field( 'artist' )` را عوض کن |

نکته‌ها:
- اگر `music_text` خالی باشد، هیچ چیز اضافه‌ای چاپ نمی‌شود (نه کادر خالی، نه `div` اضافه).
- هر دو حالتِ HTML (ویرایشگر) و متن ساده (Textarea) پشتیبانی می‌شود؛ در حالت متن ساده `nl2br` خط‌ها را نگه می‌دارد.
- اسکیما با `wp_json_encode` و بدون `JSON_UNESCAPED_SLASHES` چاپ می‌شود تا محتوای متن نتواند از تگ `script` بیرون بزند.
- گوگل برای «متن ترانه» ریچ‌رزالت ندارد؛ ارزش این اسکیما در درک موجودیت و استنادپذیری در پاسخ‌های هوش مصنوعی است (توضیح کامل در `docs/LYRICS-BOX-SEO-AIO.md`).

### لینک «سایر آهنگ‌های …» روی تاکسونومی `singer`

لینک چیپ با `get_term_link()` روی تاکسونومی خواننده ساخته می‌شود؛ یعنی دقیقاً:

```
https://ahangban.ir/singer/mohsen-yaganeh
```

ترتیب پیدا کردن ترم: فیلد اختیاری `artist_link` (اگر پر باشد) ← ترم `singer` با همان نام فیلد `artist` ← ترم `singer` با اسلاگ ← جست‌وجوی تقریبی پس از نرمال‌سازی `ي/ك/ة` و نیم‌فاصله ← برچسب هم‌نام ← و اگر چیزی پیدا نشد، چیپ **نمایش داده نمی‌شود** (لینک خراب یا `#` ساخته نمی‌شود). فیلتر `taranehyar_artist_url` هم برای بازنویسی دستی هست.

### تیتر بخش دانلود

```php
<h2 class="dl_title">
	<i class="icofont-download" aria-hidden="true"></i>دانلود <span class="dl_title_type">آهنگ</span> <span class="dl_title_song">X</span> از <span class="dl_title_artist">Y</span>
</h2>
```

- نوع از فیلد `musics_type` می‌آید؛ اگر خالی باشد «آهنگ» → برای آلبوم‌ها خودکار «دانلود آلبوم X از Y» می‌شود.
- فقط وقتی چاپ می‌شود که حداقل یکی از فیلدهای `music128/320`، `album128/320` یا `video480/720/1080` پر باشد.
- خاموش کردن: `$taranehyar_download_title = false;` در همان بلوک `single.php`.
- هم‌خانواده با بقیهٔ قالب: گوشهٔ دکمه‌های دانلود هم از `3px` به `10px` رسید و همه وسط‌چین شدند.

### رفع نمایش‌داده‌نشدن صفحهٔ خواننده (`singer`)

فایل جدید `taxonomy-singer.php` آرشیو خواننده را بازنویسی می‌کند:

- به‌جای شش کوئری با تطبیق دقیق `musics_type = mp3|mp4|album`، **یک کوئری** می‌زند و در PHP دسته‌بندی می‌کند؛ مقدار فیلد نرمال‌سازی می‌شود و مترادف‌ها (`آهنگ`، `audio`، `کلیپ`، `آلبوم`، حروف بزرگ و…) هم شناخته می‌شوند. **هیچ نوشته‌ای پنهان نمی‌ماند** (ناشناخته‌ها در «سایر موارد»).
- اگر خواننده هیچ نوشته‌ای نداشته باشد، پیام روشن نشان می‌دهد (قبلاً صفحهٔ خالی بود).
- اگر ترم به‌درستی بارگذاری نشود، پیام «صفحه در دسترس نیست» + راهنمای بازسازی پیوندهای یکتا نشان می‌دهد.
- کلاس‌های CSS و ظاهر قالب دست‌نخورده مانده‌اند.

و در `myfunctions.php` (انتهای فایل) شبکهٔ ایمنی اضافه شد:

- اگر تاکسونومی `singer` **ثبت نشده باشد**، همان با تنظیمات درست ثبت می‌شود.
- اگر ثبت شده ولی `public/publicly_queryable` نباشد، روشن می‌شود (اسلاگ دلخواه شما تغییر نمی‌کند).
- **یک‌بار** قوانین پیوند یکتا بازسازی می‌شود (کافی است یک بار پیشخوان را باز کنید).
- خاموش کردن کل بلوک: `JAVANSEDA_SINGER_FIX_OFF = true`.

**تشخیص روی سایت خودتان** (فقط مدیر، خروجی متن ساده):

| آدرس | پاسخ چه سؤالی |
|---|---|
| `?ab_singer_diag=1` | آیا تاکسونومی هست؟ عمومی است؟ چند ترم دارد؟ لینک‌ها سالم‌اند؟ |
| `?ab_singer_diag=1&ab_singer_term=mohsen-yeganeh` | ترم هست؟ چند نوشته دارد؟ پرتکرارترین مقدار `musics_type` چیست؟ |
| `?ab_singer_diag=1&ab_singer_term=محسن یگانه` | همین بررسی با نام فارسی |

راه‌حل دستی مکمل: پیشخوان ← تنظیمات ← پیوندهای یکتا ← ذخیرهٔ تغییرات (یک‌بار).

جزئیات کامل در `docs/SINGER-ARCHIVE-DIAGNOSIS.md`.

---

## نصب

1. از فایل‌ها و دیتابیس سایت بکاپ بگیر.
2. در مسیر `wp-content/themes/<پوشهٔ قالب فعلی>` این چهار فایل را با همین چهار فایل جایگزین کن (فایل‌منیجر هاست یا FTP):
   `single.php` · `style.css` · `myfunctions.php` · `taxonomy-singer.php`
   (اگر فقط صفحهٔ خواننده را می‌خواهی: `taxonomy-singer.php` + `myfunctions.php` کافی است.)
3. کش افزونهٔ کش، CDN و مرورگر را پاک کن تا `style.css` تازه بارگذاری شود.
4. یک بار پیشخوان وردپرس را باز کن (تا بازسازی خودکار قوانین پیوند یکتا انجام شود)، بعد صفحهٔ یک خواننده را تست کن؛ اگر لازم بود، تنظیمات ← پیوندهای یکتا ← ذخیره هم بزن.
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
| تغییر رنگ کل سایت | فقط `--ab-blue` را در `:root` بالای `style.css` عوض کن |
| سایه سبک‌تر/بدون سایه | `box-shadow` را در `.single_featured_image` کم‌رنگ‌تر یا حذف کن. |
| کاور بعد از متن توضیحات | بلوک `has_post_thumbnail()` را در `single.php` به **بعد** از `the_content('')` منتقل کن. |
| در برگه‌ها (`page.php`) هم باشد | همان بلوک را در `page.php` قبل از `the_content('')` بگذار. |

## نکته‌ها

- نوشته‌های بدون تصویر شاخص هیچ چیز اضافه‌ای نمایش نمی‌دهند (جای‌گزین `nomusics.jpg` عمداً اینجا استفاده نشده است).
- اگر همان تصویر را قبلاً دستی داخل متن توضیحات گذاشته‌ای، از متن حذفش کن تا دو بار تکرار نشود.
- `alt` و `title` تصویر از عنوان نوشته خوانده می‌شود.
- افکت‌ها فقط CSS هستند؛ هیچ فایل JS اضافه‌ای لازم نیست و سرعت صفحه را پایین نمی‌آورند.
- این سه فایل روی وردپرس واقعی اجرا/آزمایش نشده‌اند (محیط PHP/WordPress در دسترس نیست)؛ فقط ساختار PHP و CSS آن‌ها بررسی شده است. قبل از اعمال روی سایت اصلی، روی staging امتحان کن.
