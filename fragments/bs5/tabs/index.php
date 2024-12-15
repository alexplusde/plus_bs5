<?php

namespace Alexplusde\BS5;

use rex_view;

/** @var \Fragment $this */
/** @var array<int,string> $content */
$content = $this->getVar('content');
$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

if (!is_array($content)) {
    echo rex_view::error('Kein Inhalt vorhanden.');
    return;
}
?>
<!-- BEGIN plus_bs5/fragmnents/bs5/tabs/index.php  -->
<?php
$tabId = 'tab-' . $slice_id;
?>
<section class="position-relative py-3" id="slice-<?= $slice_id ?>">
    <ul class="nav nav-underline" id="<?= $tabId ?>" role="tablist">
        <?php
        foreach ($content as $index => $item) {
            $tabPaneId = $tabId . '-pane-' . $index;
            $tabButtonId = $tabId . '-button-' . $index; // Neue ID für Button
            $tabPaneLabel = $item['name'];
            $tabPaneActive = $index === 0 ? 'active' : '';
            $tabPaneShow = $index === 0 ? 'show' : '';
        ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $tabPaneActive ?>" 
                        id="<?= $tabButtonId ?>" 
                        data-bs-toggle="tab" 
                        data-bs-target="#<?= $tabPaneId ?>" 
                        type="button" 
                        role="tab" 
                        aria-controls="<?= $tabPaneId ?>" 
                        aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                    <?= $tabPaneLabel ?>
                </button>
            </li>
        <?php
        }
        ?>
        </ul>
        <div class="tab-content py-3" id="<?= $tabId ?>-content">
            <?php
            foreach ($content as $index => $item) {
                $tabPaneId = $tabId . '-pane-' . $index;
                $tabButtonId = $tabId . '-button-' . $index; // Korrespondierende Button-ID
                $tabPaneActive = $index === 0 ? 'active' : '';
                $tabPaneShow = $index === 0 ? 'show' : '';
            ?>
                <div class="tab-pane fade <?= $tabPaneActive ?> <?= $tabPaneShow ?>" 
                     id="<?= $tabPaneId ?>" 
                     role="tabpanel" 
                     aria-labelledby="<?= $tabButtonId ?>" 
                     tabindex="0">
                    <h3><?= $item['headline'] ?></h3>
                    <?= $item['content'] ?>
                </div>
            <?php
            }
            ?>
        </div></section>
<!-- END plus_bs5/fragmnents/bs5/tabs/index.php  -->
