<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use Alexplusde\BS5\Helper;

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

/** @var Category|null $category */
$category = $this->getVar('category');

if ($category) {
    $entries = $category->getEntries();
} else {
    $entries = Entry::query()->where('status', Entry::ONLINE, '>=')->find();
}

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
            echo $this->subfragment('bs5/neues/entry.php');
        }
?>
	</div>
</div>
