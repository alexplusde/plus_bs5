<?php

namespace Alexplusde\Events;

/** @var rex_fragment|Fragment $this */


$category_id = $this->getVar('category_id');
if ($category_id > 0) {
    $dates = Category::get($category_id)->getRelatedCollection('date_ids');
} else {
    $dates = Date::query()->find();
}

$headline = $this->getVar('headline', '{{events.list.headline}}');

?>
<!-- BEGIN plus_bs5/fragments/bs5/events/list.php -->
<div class="row">
	<div class="col-xl-8">
		<h2><?= $headline ?></h2>
	</div>
</div>
<div class="events-list row g-4">
	<div class="col-12 col-md-3">
		<?php $this->subfragment('bs5/events/list-category.php') ?>
	</div>
	<div class="col-12 col-md-9">
		<?php
        foreach ($dates as $date) {
            $this->setVar('date', $date);
            echo $this->subfragment('bs5/events/date.php');
        }
?>
	</div>
</div>
<!-- END plus_bs5/fragments/bs5/events/list.php -->
