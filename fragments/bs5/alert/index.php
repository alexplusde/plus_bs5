<?php

namespace Alexplusde\School;

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/** @var rex_fragment|Fragment $this */

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$headline = $this->getVar('headline');
$headline_level = $this->getVar('headline_level') ?? "h2";
$text = $this->getVar('text');
$type = $this->getVar('type');

?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<section class="modul modul-alert p-3" id="modul-<?= $slice_id ?>">
	<div class="row">
		<div class="col-12">
			<div class="alert alert-<?= $type ?>" role="alert">
			<?= $headline ? "<p class=\"$headline_level\">$headline</p>" : "" ?>
			<?= $text ?>
			</div>
		</div>
	</div>
</section>
