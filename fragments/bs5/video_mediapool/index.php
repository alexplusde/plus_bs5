<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use rex_plyr;

/** @var rex_fragment $this */
$slice_id = $this->getVar('slice_id');

$video = $this->getVar('video');
$options = $this->getVar('options');

$thumbnail = \rex_media_plus::get($this->getVar('thumbnail'));
if($thumbnail) {
    $thumbnail = $thumbnail->getUrl();
}
?>
<section class="ratio ratio-16x9" id="modul-REX_SLICE_ID">
    <div>
            <?= rex_plyr::outputMedia($video, $options, $thumbnail); ?>
</div>
</section>
