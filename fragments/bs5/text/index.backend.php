<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\MediaManagerResponsive\Media;

/** @var rex_fragment|Fragment $this */


$headline = $this->getVar('headline');
$headline_level = $this->getVar('headline_level') ?? "h2";
$teaser = $this->getVar('teaser');
$text = $this->getVar('text');
$cta = $this->getVar('cta');
$imagePosition = $this->getVar('imagePosition');

$image = $this->getVar('image');
$media = Media::get($image);
?>
<section class="modul modul-text py-3" id="modul-REX_SLICE_ID">
	<div class="row">
		<?php if (null !== $media) { ?>
			<div class="col-md-6 image">
				<?= $media->setClass('img-fluid')->getImg('wysiwyg') ?>
			</div>
			<div class="col-md-6 text">
				<?php if ($headline) { ?>
					<<?= $headline_level ?>><?= $headline ?></<?= $headline_level ?>>
				<?php } ?>
				<?= $teaser ?>
				<?= $text ?>
			</div>
		<?php } else { ?>
			<div class="col-md-12 text">
				<?php if ($headline) { ?>
					<<?= $headline_level ?>><?= $headline ?></<?= $headline_level ?>>
				<?php } ?>
				<?= $teaser ?>
				<?= $text ?>
			</div>
		<?php } ?>
		<div class="col-md-12 text text-cta">
			<?= Fragment::ctaFormatter($cta) ?>
		</div>
	</div>
</section>
