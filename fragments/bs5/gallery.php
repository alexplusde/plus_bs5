<?php

$layout = $this->getVar('options')['layout'] ?? "full-width";
?>
<section
	class="modul modul-gallery bs5-gallery bs5-gallery-<?= $layout ?>">
	<?= $this->subfragment("bs5/gallery/".$layout.".php"); ?>
</section>
