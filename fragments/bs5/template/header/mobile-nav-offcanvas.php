<?php

namespace Alexplusde\BS5;

/** @var \Fragment $this */

use rex_article;
use rex_config;

?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileOffCanvasNavigation" aria-labelledby="{{template-header-mobile-navigation.menu}}">
  <div class="offcanvas-header">
    <p class="offcanvas-title h5" id="offcanvasLabel">{{template.header-mobile-navigation.title}}</p>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{ template.header-mobile-navigation.close }}"></button>
  </div>
  <div class="offcanvas-body">
    <?= MobileOffCanvasNavigation::getNav(rex_config::get('plus_bs5', 'nav_depth', 2)) ?>
  </div>
  <div class="offcanvas-footer p-3">
    <?php
    $footer_nav = explode(',', rex_config::get('plus_bs5', 'footer_navigation'));
foreach ($footer_nav as $id) {
    $article = rex_article::get($id);
    if ($article) { ?>
        <a href="<?= $article->getUrl() ?>" class="text-muted me-3"><?= $article->getName() ?></a>
    <?php }
    } ?>
  </div>
</div>
