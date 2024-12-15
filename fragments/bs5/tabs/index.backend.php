<?php

namespace Alexplusde\BS5;

use rex_view;

/** @var \Fragment $this */
/** @var array<int,string> $content */
$content = $this->getVar('content');
$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

if(!is_array($content)) {
    echo rex_view::error('Kein Inhalt vorhanden.');
    return;
}
?>
<!-- BEGIN plus_bs5/fragmnents/bs5/tabs/index.php  -->
<?php
$tabId = 'tab-' . $slice_id;
?>
<ul class="nav nav-tabs" id="<?= $tabId ?>" role="tablist">
    <?php
    foreach ($content as $index => $item) {
        $tabPaneId = $tabId . '-pane-' . $index;
        $tabButtonId = $tabId . '-button-' . $index;
        $tabPaneLabel = $item['name'];
        $tabPaneActive = $index === 0 ? 'active' : '';
    ?>
        <li class="nav-item <?= $tabPaneActive ?>" role="presentation">
            <a class="nav-link" 
               id="<?= $tabButtonId ?>" 
               data-toggle="tab" 
               href="#<?= $tabPaneId ?>" 
               role="tab" 
               aria-controls="<?= $tabPaneId ?>" 
               aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                <?= $tabPaneLabel ?>
            </a>
        </li>
    <?php
    }
    ?>
</ul>
<div class="tab-content" id="<?= $tabId ?>-content">
    <?php
    foreach ($content as $index => $item) {
        $tabPaneId = $tabId . '-pane-' . $index;
        $tabButtonId = $tabId . '-button-' . $index;
        $tabPaneActive = $index === 0 ? 'active' : '';
        $tabPaneShow = $index === 0 ? 'in' : '';
    ?>
        <div class="tab-pane fade <?= $tabPaneActive ?> <?= $tabPaneShow ?>" 
             id="<?= $tabPaneId ?>" 
             role="tabpanel" 
             aria-labelledby="<?= $tabButtonId ?>">
            <h3><?= $item['headline'] ?></h3>
            <?= $item['content'] ?>
        </div>
    <?php
    }
    ?>
</div><!-- END plus_bs5/fragmnents/bs5/tabs/index.php  -->
