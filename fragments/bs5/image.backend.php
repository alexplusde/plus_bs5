<?php

$layout = $this->getVar('options')['layout'] ?? 'full-width';
?>
<section
	class="modul modul-image bs5-image bs5-image-<?= $layout ?>">
	<?= $this->subfragment('bs5/image/'.$layout.'.backend.php') ?>
</section>
