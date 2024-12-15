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
<!-- BEGIN plus_bs5/fragmnents/bs5/accordion/index.backend.php  -->
<?php
$accordionId = 'accordion-' . $slice_id;
?>
<div class="panel-group" id="<?= $accordionId ?>" role="tablist" aria-multiselectable="true">
    <?php
    foreach ($content as $index => $item) {
        $panelId = $accordionId . '-collapse-' . $index;
        $headingId = $accordionId . '-heading-' . $index;
        $isExpanded = $index === 0 ? 'true' : 'false';
        $showPanel = $index === 0 ? 'in' : '';
    ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="<?= $headingId ?>">
                <h4 class="panel-title">
                    <a role="button" 
                       data-toggle="collapse" 
                       data-parent="#<?= $accordionId ?>" 
                       href="#<?= $panelId ?>" 
                       aria-expanded="<?= $isExpanded ?>" 
                       aria-controls="<?= $panelId ?>">
                        <?= $item['name'] ?>
                    </a>
                </h4>
            </div>
            <div id="<?= $panelId ?>" 
                 class="panel-collapse collapse <?= $showPanel ?>" 
                 role="tabpanel" 
                 aria-labelledby="<?= $headingId ?>">
                <div class="panel-body">
                    <h3><?= $item['headline'] ?></h3>
                    <?= $item['content'] ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<!-- END plus_bs5/fragmnents/bs5/accordion/index.backend.php  -->
