<?php

namespace Alexplusde\BS5;

use Alexplusde\MediaManagerResponsive\Media;

/** @var rex_fragment|Fragment $this */

$title = $this->getVar('title');
$teaser = $this->getVar('teaser');

$image = $this->getVar('image');
$media = Media::get($image);
?>
<div class="row">
    <div class="col-12 col-md-8">
        <h1 class="my-3"><?= $title ?></h1>
        <p><?= $teaser ?></p>
    </div>
    <?php if($media) { ?>
    <div class="col-12 col-md-4">
        <?= $media->getPicture('') ?>
    </div>
    <?php } ?>
</div>
