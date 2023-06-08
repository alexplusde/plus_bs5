<?php

$image = $this->getVar('image');

?>
<div>
	<div class="ratio ratio-16x9">
		<iframe
			src="/media/<?= $this->getVar('video') ?>"
			title="<?= $this->getVar('title') ?>"
			allowfullscreen></iframe>
	</div>
</div>
