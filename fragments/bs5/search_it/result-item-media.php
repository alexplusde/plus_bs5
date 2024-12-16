<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */

$hit = $this->getVar('hit');
$hit_link = $this->getVar('hit_link');
$url_info = $this->getVar('url_info');
$title = $this->getVar('title');

?>
<li class="card p-3 mb-3">
    <p class="h5">
        <a href="<?= $hit_link ?>" title="<?= $title ?>"><?= $title ?></a>
    </p>
    <p class="search_it-teaser"><?= $hit['highlightedtext'] ?></p>
    <p class="text-muted">
        <a href="<?= $hit_link ?>" title="<?= $title ?>">
            <?= $hit_link ?>
        </a>
    </p>
</li>
