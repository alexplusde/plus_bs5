<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

$category = rex_category::get("REX_VALUE[1]") ?? rex_category::getCurrent();
?>
<section class="modul-article" id="modul-REX_SLICE_ID">
<?= Helper::getBackendEditLink("REX_ARTICLE_ID", null, "REX_SLICE_ID") ?>
    <?php

    $articles = $category->getArticles(true);

    if ($articles !== null) {

        $category_fragment = new Fragment();
        $category_fragment->setVar('articles', $articles);

        
$category_fragment->setVar('slice_id', "REX_SLICE_ID");
$category_fragment->setVar('article_id', "REX_ARTICLE_ID");

        echo $category_fragment->parse('bs5/articles/index.php');
    } else {

        /* Instruktionen */
        Helper::showBackendUserInstruction("Es wurde eine Kategorie ausgewählt, diese enthält jedoch keine weiteren Artikel.");
    }
    ?>
</section>
