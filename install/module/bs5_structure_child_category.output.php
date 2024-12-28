<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

?>
<section class="modul-category-cards" id="modul-REX_SLICE_ID">

    <?php
    $articleId = $this->getValue("article_id");
$selected_category = rex_category::get($this->getValue("category_id"));

$categories = $selected_category->getChildren(true);


if ($categories !== null) {

    $category_fragment = new Fragment();
    $category_fragment->setVar('slice_id', "REX_SLICE_ID");
    $category_fragment->setVar('article_id', "REX_ARTICLE_ID");

     
    $category_fragment->setVar('categories', $categories);

    echo $category_fragment->parse('bs5/category/index.php');
} else {
    echo '<p>Keine Unterkategorien vorhanden</p>';
}
?>
</section>
