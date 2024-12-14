<?php

use Alexplusde\BS5\Fragment;

/** @var rex_fragment|Fragment $this */

$cta = $this->getVar('cta');
?>
<!-- BEGIN plus_bs5/fragments/bs5/atom/cta.php -->
<?= Fragment::ctaFormatter($cta) ?>
<!-- END plus_bs5/fragments/bs5/atom/cta.php -->
