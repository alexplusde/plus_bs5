
<?php

use Alexplusde\BS5\Fragment;

/** @var Fragment $this */
?>
<main id="content" class="content min-vh-100">
    <article class="container">
<?php

 if (rex_article::getCurrent()->getValue('art_hide_intro') !== "0") {

    $output = new Fragment();

     $output->setVar('title', rex_article::getCurrent()->getName(), false);
     $output->setVar('teaser', rex_article::getCurrent()->getValue('yrewrite_description'), false);

     /* REX_MEDIA */
     $output->setVar('image', rex_article::getCurrent()->getValue('yrewrite_image'));

     echo $output->parse('bs5/template/main-intro.php');
 }
?>
<h1><?= rex_article::getCurrent()->getName() ?></h1>
<?= $this->getVar('content') ?>
    </article>
</main>
