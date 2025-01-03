<!-- BEGIN plus_bs5/fragments/neues/index-backend.php -->
<?php

/** @var Fragment $this */

$category_ids = $this->getVar('category_ids', []);

if(empty($category_ids)) {

    echo rex_view::info('Alle Kategorien werden ausgegeben.');

} else {

    $category_collection = FriendsOfRedaxo\Neues\Category::query()->find()->filter(
        // Callback nutzen um nur Kategorien zu filtern, die in den $category_ids sind.
        function ($category) use ($category_ids) {
            return in_array($category->getId(), $category_ids);
        }
    );

    $badges = '';
    foreach ($category_collection as $category) {
        $badges .= '<div class="badge bg-primary">' . $category->getName() . '</div>';
    }

    echo rex_view::info('Es werden nur die News angezeigt, die in den ' . $badges . ' enthalten sind.');

}

$title = $this->getVar('title');
$teaser = $this->getVar('teaser');

echo '<h1>' . $title . '</h1>';
echo '<p>' . $teaser . '</p>';

?>
<!-- END plus_bs5/fragments/neues/index-backend.php -->
