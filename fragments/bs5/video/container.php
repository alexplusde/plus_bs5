<?php

$image = $this->getVar('image');

?>
<div
	class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
	<div class="ratio ratio-16x9 w-100">
		<iframe src="<?= $this->getVar('url') ?>"
			title="<?= $this->getVar('title') ?>"
			allowfullscreen></iframe>
	</div>
</div>
