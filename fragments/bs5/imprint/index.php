<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/** @var rex_fragment|Fragment $this */

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$headline = $this->getVar('headline');
$headline_level = $this->getVar('headline_level') ?? "h2";
// $text = $this->getVar('text');

?>
<section class="modul modul-text py-3" id="modul-<?= $slice_id ?>">
	<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
	<div class="row">
		<div class="col-12 text">
			<?php if ($headline) { ?>
			<<?= $headline_level ?>><?= $headline ?>
			</<?= $headline_level ?>>
			<?php } ?>
			<?= $text ?>
		</div>
	</div>
</section>
