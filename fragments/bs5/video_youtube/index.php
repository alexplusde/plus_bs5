<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;

/** @var rex_fragment $this */
$slice_id = $this->getVar('slice_id');

$data_id = $this->getVar('data_id');
$data_thumbnail = $this->getVar('data_thumbnail');

$media = \rex_media_plus::get($data_thumbnail);
$thumbnail = '';
if($media) {
    $thumbnail = $media::getFrontendUrl($media, '');
} 

?>
<section class="ratio ratio-16x9" id="modul-<?= $slice_id ?>">
        <div class="video"
             data-service="youtube"
             data-id="REX_VALUE[1]"
             <?php
                if($thumbnail) {
                    echo 'data-thumbnail="'.$thumbnail.'"';
                }
                ?>
             data-params="loop=1&autoplay=0&mute=1"
             data-autoscale data-ratio="16:9">
        </div>
</section>
