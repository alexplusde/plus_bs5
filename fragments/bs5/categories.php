<?php

namespace Alexplusde\BS5;

/** @var rex_fragment $this */

use rex_category;

$categories = $this->getVar('categories', rex_category::getCurrent()->getChildren());

?>
<!-- BEGIN plus_bs5/fragments/bs5/categories.php -->
<div class="row row-cols-1 row-cols-md-2 g-4">
<?php

foreach ($categories as $category) {
?>
	<div class="col mb-3">
		<div class="card h-100">
			<div class="card-body">
				<h3 class="card-title">
					<?= $category->getName() ?>
				</h3>
				<p class="card-text">
					<?= $category->getValue('yrewrite_description') ?>
				</p>
			</div>
			<div class="card-footer text-end">
				<a href="<?= $category->getUrl() ?>"
					class="btn btn-primary">Mehr...</a>
			</div>

		</div>
	</div>
<?php
}
?>
</div>
<!-- END plus_bs5/fragments/bs5/categories.php -->
