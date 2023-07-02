<?php

$images = explode(',', $this->getVar('images'));

?>

<section class="container bs5_gallery">
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
