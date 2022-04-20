<?php

$image = $this->getVar('image');

?>

<section class="modul modul-image bs5-image">
    <div
        class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
        <?php

     if ($media = rex_media::get($image)) {
         ?>
        <?= media_manager_type_group::getPicture('default', $image); ?>
        <h5><?= $image ?>
        </h5>
        <p><?= $media->getValue('med_description'); ?>
        </p>
        <?php
     } // if $media
?>

    </div>
</section>