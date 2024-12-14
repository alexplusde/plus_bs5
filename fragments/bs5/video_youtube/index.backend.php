<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;

/** @var rex_fragment|Fragment $this */

$slice_id = $this->getVar('slice_id');

$data_id = $this->getVar('data_id');
$data_thumbnail = $this->getVar('data_thumbnail');


?>
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item"
        src="https://www.youtube.com/embed/<?= $data_id ?>?rel=0"
        width="600"
        height="450">
    </iframe>
</div>

<?php

$media = \rex_media_plus::get($data_thumbnail);
if ($media) {
?>
    <p>Vorschaubild für das Video:</p>
    <?= $media->getImg(); ?>
<?php
}
