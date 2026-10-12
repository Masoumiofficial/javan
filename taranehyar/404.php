<?php get_header(); ?>
<?php get_template_part( 'inc/breadcrumbs' ); ?>
<div class="tarlanweb_center">
	<div id="centers_box">
		<div class="fulls_post_txt p404-textc">
			<img class="aligncenter" src="<?php echo esc_url( get_template_directory_uri() . '/images/error404.jpg' ); ?>" width="626" height="496" alt="خطای ۴۰۴">
			<p>خطای ۴۰۴ نشان می‌دهد مطلبی که به دنبال آن هستید وجود ندارد. ممکن است حذف شده باشد یا هنوز منتشر نشده باشد.</p>
			<p>اگر مطمئن هستید این مطلب قبلاً منتشر شده، لطفاً از راه‌های ارتباطی سایت با مدیران تماس بگیرید.</p>
			<p aria-live="polite">در حال هدایت به صفحهٔ اصلی طی <span id="home-redirect-count">۱۵</span> ثانیه…</p>
			<p><a id="home-redirect-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">رفتن به صفحهٔ اصلی</a></p>
			<script>
			(function () {
				var homeLink = document.getElementById('home-redirect-link');
				var countdown = document.getElementById('home-redirect-count');
				var remaining = 15;

				if (!homeLink) {
					return;
				}

				var countdownTimer = window.setInterval(function () {
					remaining -= 1;
					if (countdown) {
						countdown.textContent = String(remaining);
					}
					if (remaining <= 0) {
						window.clearInterval(countdownTimer);
					}
				}, 1000);

				window.setTimeout(function () {
					window.location.assign(homeLink.href);
				}, 15000);
			})();
			</script>
			<div class="clear"></div>
		</div>
		<div class="clear2"></div>
	</div>
</div>
<?php get_footer(); ?>
