<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */

$layout = $this->getVar('options')['layout'] ?? 'fullwidth-list.php';

?>
<!-- BEGIN plus_bs5/fragments/bs5/gallery/index.php -->
?>
<section
	class="modul modul-gallery bs5-gallery bs5-gallery-<?= $layout ?>">
	<?= $this->subfragment('bs5/gallery/' . $layout . '.php') ?>
</section>
<!-- END plus_bs5/fragments/bs5/gallery/index.php -->
