<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use Alexplusde\BS5\Helper;
use rex_yform_manager_collection;

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

/** @var rex_yform_manager_collection|null $entries */
$entries = $this->getVar('entries');

$total = $this->getVar('total');
$limit = 10;
$offset = rex_get('page', 'int', 1) * $limit - $limit;

if ($total <= $limit) {
    return;
}
?>
<!-- BEGIN plus_bs5/fragments/neues/list-pagination.php -->
<nav aria-label="Seite wählen">
    <ul class="pagination justify-content-center">
        <?php
        if ($offset > 0) {
        ?>
            <li class="page-item">
                <a class="page-link" href="<?= rex_getUrl(null, null, ['page' => rex_get('page', 'int', 1) - 1]) ?>">Previous</a>
            </li>
        <?php
        } else {
        ?>
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>
        <?php
        }

        foreach (range(1, ceil($total / $limit)) as $page) {
        ?>
            <li class="page-item <?= rex_get('page', 'int', 1) === $page ? 'active' : '' ?>">
                <a class="page-link" href="<?= rex_getUrl(null, null, ['page' => $page]) ?>"><?= $page ?></a>
            </li>
        <?php
        }

        if ($offset + $limit < $total) {
        ?>
            <li class="page-item">
                <a class="page-link" href="<?= rex_getUrl(null, null, ['page' => rex_get('page', 'int', 1) + 1]) ?>">Next</a>
            </li>
        <?php
        } else {
        ?>
            <li class="page-item disabled">
                <a class="page-link">Next</a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>
<!-- END plus_bs5/fragments/neues/list-pagination.php -->
