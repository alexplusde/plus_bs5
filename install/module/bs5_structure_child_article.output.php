<?php

/** @var rex_article_content $this */

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

$category = rex_category::get("REX_VALUE[1]") ?? rex_category::getCurrent();
?>
<section class="modul-article" id="modul-REX_SLICE_ID">
    <?php

    $articles = $category->getArticles(true);

    if ($articles !== null) {

        $category_fragment = new Fragment();
        $category_fragment->setVar('articles', $articles);

        echo $category_fragment->parse('bs5/articles/index.php');
    } else {

        /* Instruktionen */
        Helper::showBackendUserInstruction("Es wurde eine Kategorie ausgewählt, diese enthält jedoch keine weiteren Artikel.");
    }
    ?>
</section>
