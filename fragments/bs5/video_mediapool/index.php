<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;
use rex_plyr;

/** @var rex_fragment|Fragment $this */

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$video = $this->getVar('video');
$options = $this->getVar('options');

$thumbnail = \rex_media_plus::get($this->getVar('thumbnail'));
if($thumbnail) {
    $thumbnail = $thumbnail->getUrl();
}
?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<section class="ratio ratio-16x9" id="modul-REX_SLICE_ID">
    <div>
            <?= rex_plyr::outputMedia($video, $options, $thumbnail); ?>
</div>
</section>
