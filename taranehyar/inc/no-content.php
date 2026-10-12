<div class="fulls_post_txt p404-textc">
	<img class="aligncenter" src="<?php echo esc_url( get_template_directory_uri() . '/images/error404.jpg' ); ?>" width="626" height="496" alt="محتوایی پیدا نشد">
	<p>محتوایی برای نمایش پیدا نشد. ممکن است مطلب حذف شده باشد یا هنوز منتشر نشده باشد.</p>
	<p>در حال هدایت به صفحهٔ اصلی طی <span id="home-redirect-count">۱۵</span> ثانیه…</p>
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
