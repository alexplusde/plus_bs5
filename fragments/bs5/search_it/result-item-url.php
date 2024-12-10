<?php

namespace Alexplusde\BS5;

/** @var rex_fragment $this */

$hit = $this->getVar('hit');
$hit_link = $this->getVar('hit_link');
$url_info = $this->getVar('url_info');
$url_sql = $this->getVar('url_sql');
$url_profile = $this->getVar('url_profile');
$hit_server = $this->getVar('hit_server');

?>
<li class="card p-3 mb-3">
    <p class="h5">
        <a href="<?= $hit_link ?>" title="<?= $url_info['title'] ?>"><?= $url_info['title'] ?></a>
    </p>
    <p class="search_it-teaser"><?= $hit['highlightedtext'] ?></p>
    <p class="text-muted">
        <a href="<?= $hit_link ?>" title="<?= $url_info['title'] ?>">
            <?= $hit_server . rex_getUrl($url_sql->getValue('article_id'), $url_sql->getValue('clang_id'), [$url_profile->getNamespace() => $url_sql->getValue('data_id')]) ?>
        </a>
    </p>
</li>
