<?php

namespace FriendsOfRedaxo\Neues;

/** @var rex_fragment $this */
$entry = $this->getVar('entry');
/** @var Entry $entry */
?>
<div class="sh_neues card mb-4">
	<div class="card-body">

		<p>
			<?php
                    $categories = $entry->getCategories();
foreach ($categories as $category) {
    /** @var Category $category */

    ?>
			<span
				class="badge badge-primary text-white p-1"><?= $category->getName() ?></span>
			<?php
}
?>
			<?= $entry->getFormattedPublishDateTime() ?> Uhr
		</p>
		<h2 class="h4"><?= $entry->getName() ?></h2>
		<p class="sh_neues-teaser">
			<?= $entry->getTeaser() ?>
		</p>
		<a href="<?= $entry->getUrl() ?>"
			class="btn btn-medium btn-primary">{{neues.entry.more}}</a>
	</div>

</div>