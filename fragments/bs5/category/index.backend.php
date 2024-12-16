<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use rex_config;
use rex_category;

$layout = $this->getVar('options')['layout'] ?? 'no-image';
?>
<!-- BEGIN plus_bs5/fragments/bs5/category/index.backend.php -->
<div class="row">

    <?php
    $parent = rex_category::get($this->getVar('category'));
    if (!$parent) {
        $parent = rex_category::getCurrent();
    }
    $categories = $parent->getChildren();

    foreach ($categories as $category) {
        if (1 != $category->getValue('status')) {
            continue;
        }

        $this->setVar('parent', $parent);
        $this->setVar('structure', $category);

        echo $this->subfragment('bs5/structure/' . $layout . '.php');
    }
    ?>
</div>
<!-- END plus_bs5/fragments/bs5/category/index.backend.php -->
