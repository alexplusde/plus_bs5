<?php 

$structure = $this->getVar('structure'); 
$media = rex_media_plus::get($structure->getValue('yrewrite_image'));
if($media) {
    $background_image = $media->getUrl();
}
?>
<div class="col">
    <a href="<?= $structure->getUrl(); ?>" class="card border-0 shadow h-100 ratio ratio-16x9 position-relative"
        style="background-image: url(<?= $background_image ?>); background-size: cover; background-position: center;">
        <div class="card-body position-relative">
            <h3 class="card-title position-absolute bottom-0 start-0 text-white bg-primary m-3 p-1 d-inline-block">
                <?= $structure->getName() ?>
            </h3>
        </div>
    </a>
</div>
