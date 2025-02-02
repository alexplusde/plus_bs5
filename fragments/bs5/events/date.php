<?php

namespace Alexplusde\Events;

/** @var rex_fragment|Fragment $this */


$date = $this->getVar('date');
$category = $date->getCategory();
?>
<!-- BEGIN plus_bs5/fragments/bs5/events/date.php -->
<div class="event card mb-4">
	<div class="card-body">
		<?php
        $categories = $date->getCategories();
foreach ($categories as $category) {
    ?>
		<p>
			<span
				class="badge bg-secondary p-2 text-body"><?= $category->getName() ?></span>
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
<!-- END plus_bs5/fragments/bs5/events/date.php -->
