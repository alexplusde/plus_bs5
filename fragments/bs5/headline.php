<section class="bs5-headline">
	<?= media_manager_type_group::getBackgroundStyles($this->getVar('image'), 'bs5_title', '#bs5-hero-bg-image');
    ?>
	<div class="" id="bs5-headline-bg-image" style="background-size: cover; background-position: center">
		<div class="container mx-auto">
			<h2>
				<?= $this->getVar('title') ?>
			</h2>
		</div>
	</div>
</section>