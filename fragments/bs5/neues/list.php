<?php

/** @var rex_fragment $this */

namespace FriendsOfRedaxo\Neues;

/** @var Category|null $category */
$category = $this->getVar('category');

if ($category) {
	$entries = $category->getEntries();
} else {
	$entries = Entry::query()->where('status', Entry::ONLINE, '>=')->find();
}

?>
<div class="row g-4">
	<div class="col-12 col-md-3">
		<?php $this->subfragment("bs5/neues/list-nav.php"); ?>
	</div>
	<div class="col-12 col-md-9">
		<?php
		foreach ($entries as $entry) {
			/** @var Entry $entry */
			$this->setVar('entry', $entry);
			echo $this->subfragment("bs5/neues/entry.php");
		}
		?>
	</div>
</div>
