<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content_editor $this */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\MForm;

/* Addon-Prüfung */
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

$mform = new MForm();

$mform->defaultFactory(1,2,4);

$mform->addSelectField(8)
    ->setAttribute('multiple', 'multiple')
    ->setLabel('Kategorie')
    ->setOptions($categories_array);

echo $mform->show();
