<?php

use Alexplusde\BS5\Fragment;

/** @var rex_fragment|Fragment $this */

$level = $this->getVar('level') ?? 'h2';
?>
<!-- BEGIN plus_bs5/fragments/bs5/atom/headline-backend.php -->
<?= "<$level>{$this->getVar('headline')} <span class='badge'>{$level}</span></$level>";
?>
<!-- END plus_bs5/fragments/bs5/atom/headline-backend.php -->
