<?php

use Alexplusde\BS5\Fragment;

$cta = $this->getVar('cta');
?>
<div clas="bs5-text bs5-text-cta">
	<?= Fragment::ctaFormatter($cta) ?>
</div>
