<section data-rex-module="" data-rex-slide="" class="bs5-hero">
	<?php
    echo media_manager_type_group::getBackgroundStyles($this->getVar('bg_image'), "bs5_title", "#bs5-hero-bg-image");
	?>
	<div id="bs5-hero-bg-image" style="background-size: cover; background-position: center; min-height: 42.86vw">
		<div class="container py-5 mx-auto">
			<div class="bs5-hero--container bs5-text bg-primary p-3 col-12 col-md-6">
				<<?= $this->getVar('level') ?>
					class="bs5-hero--title d-inline-block text-white">
					<?= $this->getVar('title') ?>
				</<?= $this->getVar('level') ?>>
				<div class="bs5-hero--teaser text-white">
					<?= $this->getVar('teaser') ?>
				</div>
			</div>
		</div>
	</div>
</section>
