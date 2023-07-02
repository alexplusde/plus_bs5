<?php

$audio = rex_media::get($this->getVar('audio'));

?>
<div
	class="container <?= rex_config::get('plus_bs5', 'container_class') ?>">
	<audio controls>
  <source src="<?= $audio->getUrl() ?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>

</div>
