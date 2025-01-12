<?php

namespace Alexplusde\BS5;

use Alexplusde\BS5\Helper;

/** @var rex_fragment|Fragment $this */

$image = $this->getVar('image');
$media = \rex_media_plus::get($image);

if (!$media) {
    echo \rex_view::warning('Media not found: ' . $image);
    return;
}
?>
<!-- BEGIN plus_bs5/fragments/bs5/atom/image.backend.php -->
<div class="position-relative">
    <img src="<?= $media->getUrl() ?>" class="img-fluid" alt="<?= $media->getTitle() ?>">
    <a href="<?= Helper::getBackendMediapoolEditLink($image) ?>" class="position-absolute top-0 start-0" style="width: 100%; height: 100%;"></a>
    <!-- BS3 - Tooltip mit Title -->
    <div class="position-absolute bottom-0 start-0 bg-dark text-body p-1">
        <?= $media->getTitle() ?>
    </div>
</div>
<!-- END plus_bs5/fragments/bs5/atom/image.backend.php -->
