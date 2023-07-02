<section class="modul modul-text bs5-text">
	<div
		class="container mt-4 <?= rex_config::get('plus_bs5', 'container_class') ?>">
		<div class="row">
<div class="text-content col-md-12 p-5">
		<?php if ('' !== $this->getVar('text')) { ?>
		<?= $this->getVar('text') ?>
		<?php } ?>
		</div>
		<?php if ($this->getVar('cta')) { ?>
<div class="text-cta col-md-12 p-5">
		<?= $this->getVar('cta') ?>
		</div>
		<?php } ?>
	</div>
</section>
