<?php

use Alexplusde\BS5\Fragment;

/** @var rex_fragment|Fragment $this */

$level = $this->getVar('level') ?? 'h2';
?>
<!-- BEGINN plus_bs5/fragments/bs5/atom/headline.php -->
<?= "<$level>{$this->getVar('headline')}</$level>"; ?>
<!-- END plus_bs5/fragments/bs5/atom/headline.php -->
