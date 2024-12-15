<?php

use Alexplusde\BS5\MForm as BS5MForm;
use FriendsOfRedaxo\MForm;

if (!rex_addon::get('qanda') && !rex_addon::get('qanda')->isAvailable()) {
    echo rex_view::error(rex_i18n::msg('bs5-install-qanda'));
    return;
};

/* MForm Modul zur Auswahl von Frage-Kategorien */
$categories_array = [];

$categories = qanda_category::getAll();
foreach ($categories as $category) {
    $categories_array[$category->getId()] = $category->getName();
}

$mform = new BS5MForm();

$mform->defaultFactory(1,2,4);

$mform->addSelectField(8)
    ->setAttribute('multiple', 'multiple')
    ->setLabel('Kategorie')
    ->setOptions($categories_array);

echo $mform->show();
