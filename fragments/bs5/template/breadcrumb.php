<?php

namespace Alexplusde\BS5;

/** @var \rex_fragment $this */

use rex_article;
use rex_yrewrite;

$article = rex_article::getCurrent();

if (!Helper::packageExists('yrewrite')) {
    return;
}

$currentDomain = rex_yrewrite::getCurrentDomain();
$startArticle = rex_article::get($currentDomain->getStartId());
?>
<!-- bs5/template/breadcrumbs.php  -->
<nav class="navbar" style="background-color: #e9ecef;">
    <ol class="breadcrumb m-0">
        <?php
        $tree = $article->getParentTree();

foreach ($tree as $category) {
    /** Wenn Startartikel und Mounpoint unterschiedlich, dann Startartikel ausgeben */
    if (rex_yrewrite::isDomainMountpoint($category->getId())) {
        ?>
                <li class="breadcrumb-item"><a href="<?= $startArticle->getUrl() ?>"><?= $startArticle->getCategory()->getName() ?></a></li>
<?php
        continue;
    }

    if ($category->getId() === $article->getId()) {
        echo '<li class="breadcrumb-item active" aria-current="page">' . $article->getName() . Helper::getBackendEditLink($article->getId()) . '</li>';
        continue;
    }
    echo '<li class="breadcrumb-item"><a href="' . rex_getUrl($category->getId()) . '">' . $category->getName() . '</a></li>';
}
?>
    </ol>
    <?= $this->subfragment('bs5/template/breadcrumb-search.php') ?>
</nav>
<!-- / project/fragmetfile.ext -->
