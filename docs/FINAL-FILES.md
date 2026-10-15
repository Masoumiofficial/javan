# فایل‌های نهایی — نسخهٔ ۲۰۲۶-۱۰-۱۵ (شاخهٔ `arena/821ae065-javan`)

> همهٔ فایل‌ها در همین مخزن و روی شاخهٔ `arena/821ae065-javan` هستند. جای `<مسیر>` در لینک‌های زیر، مسیر فایل در همین جدول‌هاست. دو شکل لینک هر دو کار می‌کنند:
> - دانلود مستقیم: `https://github.com/Masoumiofficial/javan/raw/refs/heads/arena/821ae065-javan/<مسیر>`
> - مشاهدهٔ کد: `https://github.com/Masoumiofficial/javan/blob/arena/821ae065-javan/<مسیر>`

## ۱) بستهٔ «همه‌چیز» — یک دانلود

| بسته | حجم | SHA-256 | محتوا |
|---|---|---|---|
| `artifacts/javan-final-files.zip` | 71،021 بایت | `4b7812e907bdd204d5e8c852548d5df1c735c1c32a1ef3e7fb4bf0125d939fac` | `00-START-HERE.txt` + `01-upload-to-theme/` (چهار فایل) + `02-restore-if-needed/` + `03-docs/` |

اگر فقط یک چیز می‌خواهید، همین بسته را بردارید: پوشهٔ `01-upload-to-theme/` را عیناً در ریشهٔ قالب فعال کپی کنید.

## ۲) چهار فایلی که باید روی قالب گذاشته شوند

همه در **ریشهٔ پوشهٔ قالب فعال**، هم‌سطح `single.php`:

```
wp-content/themes/<پوشهٔ قالب فعال>/
├── single.php            ← جای‌گزین
├── myfunctions.php       ← جای‌گزین
├── style.css             ← جای‌گزین
└── taxonomy-singer.php   ← فایل جدید (اگر قبلاً داشتید، جای‌گزین)
```

| فایل | مسیر در مخزن | حجم | SHA-256 |
|---|---|---|---|
| `single.php` | `cover-post/single.php` | ۳۲٬۵۶۱ | `19a7d90d25ecd2a26cc84c6badd2bb674dd30dd1d09737b44cd6135a2e3080f8` |
| `style.css` | `cover-post/style.css` | ۶۹٬۸۵۴ | `69f9cc988e6909acdd3e4bd7ce0a90fc239916c3646d9d82bffe589f26f1d2d5` |
| `myfunctions.php` | `cover-post/myfunctions.php` | ۲۲٬۶۸۱ | `f75591d36ea716494cfcee608ff528617fcc8969747e86e3cb22b3642ae8f6a9` |
| `taxonomy-singer.php` | `cover-post/taxonomy-singer.php` | ۱۰٬۹۲۰ | `9702a9f884884a41fa75ea13ec5045198d2734b49ef3b2e836ff818486c0a035` |

نسخهٔ آمادهٔ آپلود همین چهار فایل، بدون پوشهٔ اضافه: `artifacts/cover-post-replacements.zip` (۳۲٬۴۷۰ بایت، `846c7ad45f8f7c6ee34eb5db0099caa1c5b74f2b848644f9a88e26c898b9eb9e`) — محتوای این بسته **بی‌پوشه** است تا مستقیم داخل پوشهٔ قالب باز شود.

## ۳) بستهٔ بازگشت (اگر چیزی خراب شد)

| بسته | حجم | SHA-256 | کاربرد |
|---|---|---|---|
| `artifacts/restore-myfunctions-previous.zip` | ۳٬۹۲۳ بایت | `b570dc34d160431934cd3070a6c57785c234fbe18cdd9bb6d0be47c94eb28708` | همان `myfunctions.php` **قبل از تغییرات ما** + راهنما |
| نسخهٔ پیشین در مخزن (شاخهٔ `main`) | `taranehyar/myfunctions.php` → لینک: `.../raw/refs/heads/main/taranehyar/myfunctions.php` | ۹٬۶۳۰ بایت | `daa2cedb76f3a105aff25c51113329f3978a0de6e139973b08dcd7684547b44f` |

نکته: فقط `myfunctions.php` است که می‌تواند مسیریابی صفحهٔ خواننده را تغییر بدهد. `single.php`، `style.css` و `taxonomy-singer.php` حداکثر ظاهر/محتوا را عوض می‌کنند.

## ۴) بستهٔ کامل قالب (برای تست یا نصب از صفر)

| بسته | حجم | SHA-256 | محتوا |
|---|---|---|---|
| `artifacts/taranehyar-1.0.0-test-build.zip` | ۱٬۵۹۷٬۴۲۰ بایت | `c7a3508ff9a5b245bee93f1566644d109d5177587c67ccdeaa51bcaac19763dc` | ۱۰۴ فایل زیر یک ریشهٔ `taranehyar/` |

هشدار: این بسته کل قالب را جای‌گزین می‌کند؛ اگر روی قالب فعال خودتان تغییر شخصی داده‌اید، بهتر است فقط چهار فایل بخش ۲ را بگذارید.

## ۵) ترتیب کار (کوتاه)

1. از چهار فایل فعلی روی هاست پشتیبان بگیرید (مثلاً `myfunctions.php.bak`).
2. چهار فایل بخش ۲ را جای‌گزین کنید (دسترسی فایل: `644`).
3. کش پلاگین کش/CDN را پاک کنید.
4. یک بار پیشخوان را باز کنید.
5. یک نوشته و یک صفحهٔ `/singer/<اسلاگ>/` را تست کنید.

**اگر نتیجه بد بود:** فایل بستهٔ بازگشت (بخش ۳) را برگردانید و کش را پاک کنید.

**تشخیص:** با حساب مدیر، همان آدرس خطادار را با `?ab_singer_diag=1` باز کنید (به‌صورت اختیاری `&ab_singer_term=<اسلاگ یا نام>`).
