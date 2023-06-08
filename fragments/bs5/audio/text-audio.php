<?php

$audio = $this->getVar('audio');

?>
	<audio controls>
  <source src="<?= $audio->getUrl() ?>" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
