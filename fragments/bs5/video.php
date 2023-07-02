<?php

$layout = $this->getVar('layout') ?? "full-width";
?>
<section
	class="modul modul-video bs5-video bs5-video-<?= $layout ?>">
	<?= $this->subfragment("bs5/video/".$layout.".php"); ?>
</section>
