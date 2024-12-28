<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Helper;

$modul = rex_var::toArray("REX_VALUE[1]");
$images = array_filter(explode(",", "REX_MEDIALIST[id=1]"));
?>
<section class="modul modul-gallery" id="modul-REX_SLICE_ID"
	data-gallery-items="<?php echo count($images); ?>"
	data-layout="<?php echo $modul['gallery_mode']; ?>">
    <?= Helper::getBackendEditLink("REX_ARTICLE_ID", null, "REX_SLICE_ID") ?>
	<div class="gallery-wrapper wrapper">
		<?php
if (isset($modul['show_title']) || isset($modul['teaser'])) {
    echo '<div class="teaser-wrapper">';
}

#### Title ####
if (isset($modul['show_title'])) {
    echo '<div class="gallery-title"><h2>';
    if (isset($modul['title'])) {
        echo $modul['title'];
    } else {
        "{{ modul:gallery:title }}";
    }
    echo '</h2></div>';
}

#### Teaser ####
if (isset($modul['teaser'])) {
    echo '<div class="gallery-teaser">';
    echo $modul['teaser'];
    echo '</div>';
}

#### Images ####
if (count($images)) {
    ?>
		<div class="images-wrapper" data-magnific="gallery">
			<ul class="list-unstyled row g-3">
				<?php
    foreach ($images as $image) {
        $media = rex_media::get($image);
        $title = $media->getValue('med_title'); ?>
				<li class="col-4">
					<a href="/media/gallery-image/<?php echo $image ?>"
						title="<?php echo $title ?>">
						<img class="img-fluid border border-primary" src="/media/gallery-thumbnail<?php if (count($images) < 3) {
						    echo "-full";
						} ?>/<?php echo $image ?>"
							alt="<?php echo $title ?>" />
					</a>
				</li>
				<?php
    } ?>
			</ul>
		</div>
		<?php
}
?>
	</div>
</section>
