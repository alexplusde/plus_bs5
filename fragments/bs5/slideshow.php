<?php

$images = explode(',', $this->getVar('images'));

?>

<section class="bs5_gallery">
	<div id="carousel-REX_SLICE_ID" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">

			<?php

$index = 0;
$active = 'active';

foreach ($images as $image) {
    if ($media = rex_media::get($image)) {
        ?>
			<button type="button" data-bs-target="#carousel-REX_SLICE_ID"
				data-bs-slide-to="<?= $index++ ?>"
				class="<?= $active ?>" aria-current="true"
				aria-label="<?= $image ?>"></button>
			<?php
        $active = '';
    } else { // if $media
        continue;
    } // if $media
    ?>

			<?php
} // foreach
?>
		</div>
		<div class="carousel-inner">

			<?php

$index = 0;
$active = 'active';
foreach ($images as $image) {
    if ($media = rex_media_plus::get($image)) {
        ?>
			<div
				class="carousel-item <?= $active ?> ratio ratio-16x9">
				<?php // media_plus::get($image)->getImg('addon_bs_fullhd');?>
				<?= media_manager_type_group::getPicture('default', $media) ?>
				<!--                    <img src="/media/addon_bs_fullhd/<?= $image ?>"
				class="d-block w-100"
				alt="<?= $media->getValue('med_title') ?>">
				-->
				<div class="carousel-caption d-none d-md-block">
					<h5><?= $media->getValue('med_title') ?>
					</h5>
					<p><?= $media->getValue('med_description') ?>
					</p>
				</div>
			</div>
			<?php
        $active = '';
    } else { // if $media
        continue;
    } // if $media
    ?>

			<?php
} // foreach
?>

		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#carousel-REX_SLICE_ID"
			data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden"><<</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#carousel-REX_SLICE_ID"
			data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">>></span>
		</button>
</section>
