<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use rex_media_plus;
use media_manager_type_group;

$images = explode(',', $this->getVar('images'));

?>
<!-- BEGIN plus_bs5/fragments/bs5/gallery/fullwidth-list.php -->
 <section class="bs5_gallery">
    <div class="row">
<?php

foreach ($images as $image) {
    if ($media = rex_media_plus::get($image)) {
        ?>
        <div class="col">
				<?= media_manager_type_group::getPicture('default', $media) ?>
    </div>
			<?php
    } // if $media
} // foreach
?>    </div>
</section>
<!-- END plus_bs5/fragments/bs5/gallery/fullwidth-list.php -->
