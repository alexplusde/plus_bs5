<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Events;

use Alexplusde\BS5\Helper;
use Alexplusde\Events\Date;
use Alexplusde\Events\Category;

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

/** @var Category|null $category */
$category = $this->getVar('category');

$total = 0;
$limit = 10;
$offset = rex_get('page', 'int', 1) * $limit - $limit;

if ($category) {
    $total = $category->getRelatedCollection('date_id')->count();
    $dates = $category->getRelatedCollection('date_id');
} else {
    $total = Date::query()->where('startDate', date('Y-m-d H:i:s'), '>=')->orderBy('startDate', 'ASC')->find()->count();
    $dates = Date::query()->orderBy('startDate',date('Y-m-d H:i:s'), 'ASC')->limit($offset, $limit)->find();
}

$this->setVar('dates', $dates);

?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<div class="row g-4">
	<div class="col-12 col-md-3">
		<?php $this->subfragment('bs5/events/list-nav.php') ?>
	</div>
	<div class="col-12 col-md-9">
		<?php
        foreach ($dates as $date) {
            /** @var Date $date */
		$this->setVar('date', $date);
            echo $this->subfragment('bs5/events/date.php');
        }


		$this->setVar('total', $total);

        echo $this->subfragment('bs5/events/list-pagination.php');
?>
	</div>
</div>
