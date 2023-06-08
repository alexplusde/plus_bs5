<?php

$image = $this->getVar('image');

?>
<div class="container p-0">
	<div class="ratio ratio-16x9 w-100">
		<iframe
			src="/media/<?= $this->getVar('video') ?>"
			title="<?= $this->getVar('title') ?>"
			allowfullscreen></iframe>
	</div>

</div>
