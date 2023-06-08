<?php

$layout = $this->getVar('layout') ?? "full-width";
?>
<section
	class="modul modul-audio bs5-audio bs5-audio-<?= $layout ?>">
	<?= $this->subfragment("bs5/audio/".$layout.".php"); ?>
</section>
