<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use rex_media;
use rex_config;

$audio = rex_media::get($this->getVar('audio'));

?>
<!-- BEGIN plus_bs5/fragments/bs5/articles/index.backend.php -->
<div
	class="container <?= rex_config::get('plus_bs5', 'container_class') ?>">
	<audio controls>
		<source src="<?= $audio->getUrl() ?>" type="audio/mpeg">
		Your browser does not support the audio element.
	</audio>
</div>
<!-- END plus_bs5/fragments/bs5/articles/index.backend.php -->
