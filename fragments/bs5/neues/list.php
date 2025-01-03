<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use rex;
use Alexplusde\BS5\Helper;

$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$total = 0;
$limit = $this->getVar('limit', 12);

$page = 1;
if (rex::isFrontend()) {
    $offset = rex_get('page', 'int', 1) * $limit - $limit;
}

/** @var Category|null $category */
$category = $this->getVar('category', null);

$category_ids = $this->getVar('category_ids', []); // enthält IDs als nicht-assoziatives Array, z.B. [1,2,3]

if ($category) {
    $total = $category->getEntries()->count();
    $entries = $category->getEntries($offset);
} else if ($category_ids !== []) {
    $total = Entry::query()->where('status', Entry::ONLINE, '>=')->find()->filter(
        // Callback nutzen um nur Einträge zu filtern, die in den $category_ids sind.
        function ($entry) use ($category_ids) {
            $entry_category_collection = $entry->getCategories();
            $entry_category_ids = $entry_category_collection->toKeyValue('id', 'id'); // [1,2,3]
            // Vergleiche, ob eine ID in entry_category_ids in category_ids vorhanden ist
            return count(array_intersect($category_ids, $entry_category_ids)) > 0;
        }
    )->count();
    $entries = Entry::query()->where('status', Entry::ONLINE, '>=')->find()->filter(
        // Callback nutzen um nur Einträge zu filtern, die in den $category_ids sind.
        function ($entry) use ($category_ids) {
            $entry_category_collection = $entry->getCategories();
            $entry_category_ids = $entry_category_collection->toKeyValue('id', 'id'); // [1,2,3]
            // Vergleiche, ob eine ID in entry_category_ids in category_ids vorhanden ist
            return count(array_intersect($category_ids, $entry_category_ids)) > 0;
        }
    );
} else {
    $total = Entry::query()->where('status', Entry::ONLINE, '>=')->find()->count();
    $entries = Entry::query()->where('status', Entry::ONLINE, '>=')->limit($offset, $limit)->find();
}

$this->setVar('entries', $entries);

?>
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<div class="row g-4">
    <?php
    if ($category !== null || $category_ids !== []) {

        if($category !== null) {
            echo '<div class="col-12"><h1 class="my-3">' . $category->getName() . '</h1></div>';
        }

        foreach ($entries as $entry) {
            /** @var Entry $entry */
            $this->setVar('entry', $entry);
            $this->setVar('total', $total);
            echo $this->subfragment('bs5/neues/entry.php');
        }
        echo $this->subfragment('bs5/neues/list-pagination.php');

    } else {
    ?>

        <div class="col-12 col-md-3">
            <?php
            $this->subfragment('bs5/neues/list-nav.php') ?>
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
    <?php
    }
    ?>
</div>
