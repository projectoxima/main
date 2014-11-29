<div class="row">
	<!-- Content -->
	<div id="content" class="col-md-12 box">
		<?php 
		if ($promo_list) {
			foreach ($promo_list as $nl) { ?>
			<div class="promo">
				<div class="promo-header"><a href="<?php echo site_url().'promo_detail/'.$nl->id; ?>"><?php echo $nl->promo_title; ?></a></div>
				<div class="promo-text"><?php echo $nl->promo_description; ?></div>
			</div>
		<?php 
			}
		} else { ?>
			<div class="empty">tidak ada berita untuk saat ini!</div>
		<?php } ?>
	</div>
	</div>
</div>