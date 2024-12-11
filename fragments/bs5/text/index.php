<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/** @var rex_fragment $this */
$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$headline = $this->getVar('headline');
$headline_level = $this->getVar('headline_level') ?? "h2";
$text = $this->getVar('text');
$cta = $this->getVar('cta');
$imagePosition = $this->getVar('imagePosition');

$image = $this->getVar('image');
$media = \rex_media_plus::get($image);
?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<section class="modul modul-text p-3" id="modul-<?= $slice_id ?>">
	<div class="row">
		<?php if (null !== $media) { ?>
			<div class="col-6 image">
				<?= $media->setClass('img-fluid')->getImg() ?>
			</div>
			<div class="col-6 text">
				<?php if ($headline) { ?>
					<<?= $headline_level ?>><?= $headline ?></<?= $headline_level ?>>
				<?php } ?>
				<?= $text ?>
			</div>
		<?php } else { ?>
			<div class="col-12 text">
				<?php if ($headline) { ?>
					<<?= $headline_level ?>><?= $headline ?></<?= $headline_level ?>>
				<?php } ?>
				<?= $text ?>
			</div>
		<?php } ?>
		<div class="col-12 text text-cta">
			<?= Fragment::ctaFormatter($cta) ?>
		</div>
	</div>
</section>
