<?php

$image = $this->getVar('image');
$title = $this->getVar('title');
$level = $this->getVar('level') ?? 'h1';
$text = $this->getVar('text');

?>
<div class="container mb-5">
	<div class="row">

		<div class="col col-12 col-md-6">
		<?php
        if ($media = rex_media_plus::get($image)) {
            echo media_manager_type_group::getPicture('default', $media);
        }
?>
		</div>

		<div class="col col-12 col-md-6">
			<?php if ($title) { ?>
			<<?= $level ?>><?= $title ?></<?= $level ?>>
			<?php } ?>
			<?= $text ?>
		</div>

	</div>
</div>
