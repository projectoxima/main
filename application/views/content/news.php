<div class="row">
	<!-- Content -->
	<div id="content" class="col-md-12 box">
		<?php 
		if ($news_list) {
			foreach ($news_list as $nl) { ?>
			<div class="news">
				<div class="news-header"><a href="<?php echo site_url().'news_detail/'.$nl->id; ?>"><?php echo $nl->news_title; ?></a></div>
				<div class="news-text"><?php echo $nl->news_description; ?></div>
			</div>
		<?php 
			}
		} else { ?>
			<div class="empty">tidak ada berita untuk saat ini!</div>
		<?php } ?>
	</div>
	</div>
</div>