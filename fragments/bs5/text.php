<?php

namespace Alexplusde\BS5;

use rex_config;
use rex_article;

/** @var \rex_fragment $this */

$article_id = rex_article::getCurrentId();
$slice_id = $this->getVar('slice_id');

?>
<section class="modul modul-text bs5-text">
	<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
	<div
		class="container mt-4 <?= rex_config::get('plus_bs5', 'container_class') ?>">
		<div class="row">
			<div class="col-md-12">
				<?php if ('' !== $this->getVar('headline')) { ?>
					<h2><?= $this->getVar('headline') ?></h2>
				<?php } ?>
			</div>
			<div class="text-content col-md-12 p-5">
				<?php if ('' !== $this->getVar('text')) { ?>
					<?= $this->getVar('text') ?>
				<?php } ?>
			</div>
			<?php if ($this->getVar('cta')) { ?>
				<div class="text-cta col-md-12 p-5">
					<?= $this->getVar('cta') ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
