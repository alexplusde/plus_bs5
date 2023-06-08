<?php

$video = $this->getVar('video');

?>
<div>
	<div class="ratio ratio-16x9 w-100">
		<iframe src="<?= $this->getVar('url') ?>"
			title="<?= $this->getVar('title') ?>"
			allowfullscreen></iframe>
	</div>
</div>
