<?php

namespace Alexplusde\Events;

use Url\Url;

/** @var rex_fragment|Fragment $this */


$manager = Url::resolveCurrent();
if ($manager) {
    /** @var Date $date */
    $date = $manager->getDataset();
    ?>
<!-- BEGIN plus_bs5/fragments/bs5/events/date-details.php -->
<div class="banner_title">
	<div class="container">
		<div class="row">
			<div class="col-xl-8">

				<p><?= $date->getFormattedStartDate() ?>,
					<?= $date->getFormattedStartTime() ?> Uhr
				</p>
				<h1><?= $date->getName() ?></h1>
				<p class="category-badges">
					<?php
                    $categories = $date->getCategories();
    foreach ($categories as $category) {
        /** @var Category $category */
        ?>
					<span
						class="badge bg-primary"><?= $category->getName() ?></span>
					<?php
    }
    ?>
			</div>
		</div>
	</div>
</div>
<section class="module- events-date">
	<div class="container">
		<div class=" events-date row g-4">

			<div class="col-md-6">
				<h2 class="h3 text-primary">{{events.date.details}}</h2>
				<p class="fw-bolder  events-teaser">
					<?= $date->getTeaser() ?>
				</p>

				<?= $date->getDescription() ?>
			</div>
			<div class="col-md-6">
				<?php
    $this->setVar('location', $date->getLocation());
    echo $this->subfragment('bs5/events/location.php');
    ?>
			</div>
		</div>

		<?= $this->getSubfragment('bs5/events/list-back.php') ?>

	</div>
</section>
<?php

}
?>
<!-- BEGIN plus_bs5/fragments/bs5/events/date-details.php -->
