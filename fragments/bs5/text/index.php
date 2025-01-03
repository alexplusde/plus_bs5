<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;
use Alexplusde\MediaManagerResponsive\Media;

/** @var rex_fragment|Fragment $this */

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$headline = $this->getVar('headline');
$headline_level = $this->getVar('headline_level') ?? "h2";
$teaser = $this->getVar('teaser');
$text = $this->getVar('text');
$cta = $this->getVar('cta');
$imagePosition = $this->getVar('imagePosition');

$image = $this->getVar('image');
$media = Media::get($image);
?>
<section class="modul modul-text py-3" id="modul-<?= $slice_id ?>">
	<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
	<div class="row">
		<?php if (null !== $media) { ?>
		<div class="col-12 col-md-6 image mb-3">
			<?= $media->setClass('img-fluid')->getPicture('bs5-container') ?>
		</div>
		<div class="col-12 col-md-6 text mb-3">
			<?php if ($headline) { ?>
			<<?= $headline_level ?>><?= $headline ?>
			</<?= $headline_level ?>>
			<?php } ?>
			<?= $teaser ?>
			<?= $text ?>
		</div>
		<?php } else { ?>
		<div class="col-12 text">
			<?php if ($headline) { ?>
			<<?= $headline_level ?>><?= $headline ?>
			</<?= $headline_level ?>>
			<?php } ?>
			<?= $teaser ?>
			<?= $text ?>
		</div>
		<?php } ?>
		<div class="col-12 text text-cta">
			<?= Fragment::ctaFormatter($cta) ?>
		</div>
	</div>
</section>
