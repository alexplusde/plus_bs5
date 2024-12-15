<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use Alexplusde\BS5\Helper;

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

/** @var Category|null $category */
$category = $this->getVar('category');

$total = 0;
$limit = 10;
$offset = rex_get('page', 'int', 1) * $limit - $limit;

if ($category) {
    $total = $category->getEntries()->count();
    $entries = $category->getEntries($offset);
} else {
    $total = Entry::query()->where('status', Entry::ONLINE, '>=')->find()->count();
    $entries = Entry::query()->where('status', Entry::ONLINE, '>=')->limit($offset, $limit)->find();
}

$this->setVar('entries', $entries);

?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<div class="row g-4">
	<div class="col-12 col-md-3">
		<?php $this->subfragment('bs5/neues/list-nav.php') ?>
	</div>
	<div class="col-12 col-md-9">
		<?php
        foreach ($entries as $entry) {
            /** @var Entry $entry */
            $this->setVar('entry', $entry);
            $this->setVar('total', $total);
            echo $this->subfragment('bs5/neues/entry.php');
        }



        echo $this->subfragment('bs5/neues/list-pagination.php');
?>
	</div>
</div>
