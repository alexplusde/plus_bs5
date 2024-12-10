<?php

/** @var rex_fragment $this */

namespace FriendsOfRedaxo\Neues;

$current_id = 0;
$categories = Category::query()->where('status', 1, '>=')->orderBy('name')->find();
if ($current_category = $this->getVar('category')) {
    $current_id = $current_category->getId();
    $all_active = '';
} else {
    $all_active = 'active';
}

?>
<div class="card">
	<div class="card-header">
		Thema wählen
	</div>
	<div class="list-group list-group-flush">
		<a class="list-group-item <?= $all_active ?>"
			href="<?= rex_getUrl(\rex_config::get('neues', 'article_id')) ?>">{{neues.category.all}}</a>
		<?php

foreach ($categories as $category) {
    /** @var event_category $category */
    $isActive = $category->getId() == $current_id ? 'active' : ''; // Überprüfen, ob die aktuelle Kategorie die gleiche ist wie die Kategorie in der Schleife
    ?>
	<a class="list-group-item <?= $isActive ?>"
		href="<?= $category->getUrl() ?>"><?= $category->getName() ?></a>

	<?php
}
?>
	</div>
</div>
