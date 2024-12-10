<?php

namespace Alexplusde\Events;

/** @var rex_fragment $this */

$date = $this->getVar('date');
$category = $date->getCategory();
?>
<div class=" event card mb-4">
	<div class="card-body">
		<?php
		$categories = $date->getCategories();
		foreach ($categories as $category) {
		?>
			<p>
				<span class="badge bg-secondary p-2 text-white"><?= $category->getName() ?></span>
			</p>
		<?php
		}
		?>
		<h2 class="h4"><?= $date->getName() ?></h2>
		<p class=" events-teaser">
			
		<?= $date->getFormattedStartDate() ?>,
		<?= $date->getFormattedStartTime() ?> Uhr – 
		<?= $date->getFormattedEndDate() ?> Uhr<br>
			<?= $date->getTeaser() ?>
		</p>
		<a href="<?= $date->getRegisterUrl() ?>"
			class="btn btn-medium btn-primary">{{ events.date.more}}</a>
	</div>

</div>
