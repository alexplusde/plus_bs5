<?php

$image = $this->getVar('image');

?>

<section class="modul modul-image bs5-image">
	<div
		class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
		<?php

     if ($media = rex_media_plus::get($image)) {
         ?>
		<?= media_manager_type_group::getPicture('default', $media); ?>
		<p class="bs5-image-title"><?= $media->getTitle() ?></p>
		<p class="bs5-image-description">
			<?= $media->getValue('med_description'); ?>
		</p>
		<?php
     } // if $media
?>

	</div>
</section>
