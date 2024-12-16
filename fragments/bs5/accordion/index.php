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
<!-- BEGIN plus_bs5/fragments/bs5/accordion/index.php  -->
<?php
$accordionId = 'accordion-' . $slice_id;
?>
<section class="position-relative py-3" id="slice-<?= $slice_id ?>">
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
    <div class="accordion" id="<?= $accordionId ?>">
        <?php
        foreach ($content as $index => $item) {
            $itemId = $accordionId . '-collapse-' . $index;
            $headerId = $accordionId . '-heading-' . $index;
            $expanded = $index === 0 ? 'true' : 'false';
            $show = $index === 0 ? 'show' : '';
        ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="<?= $headerId ?>">
                    <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" 
                            type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#<?= $itemId ?>" 
                            aria-expanded="<?= $expanded ?>" 
                            aria-controls="<?= $itemId ?>">
                        <?= $item['name'] ?? "" ?>
                    </button>
                </h2>
                <div id="<?= $itemId ?>" 
                     class="accordion-collapse collapse <?= $show ?>" 
                     aria-labelledby="<?= $headerId ?>" 
                     data-bs-parent="#<?= $accordionId ?>">
                    <div class="accordion-body">
                        <h3><?= $item['headline'] ?? "" ?></h3>
                        <?= $item['content'] ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>
<!-- END plus_bs5/fragments/bs5/accordion/index.php  -->
