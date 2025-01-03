<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content_editor $this */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\MForm as BS5MForm;
use FriendsOfRedaxo\Neues\Category;

/* Addon-Prüfung */
$requiredAddons = ['yform', 'neues'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Die News-Beiträge werden in REDAXO über den Menüpunkt 'Aktuelles' verwaltet.", Helper::getBackendPageLink('neues'));

/* MForm-Formular mit Parametern */

// optional. Kategorien des Addons "Neues" als MForm-Select-Feld
$categories = [];
Category::getAll()->filter(function ($category) use (&$categories) {
    $categories[$category->id] = $category->name;
});

$MForm = BS5MForm::defaultFactory(1,2,3);

$MForm->addFieldsetArea('Einstellungen für die News-Ausgabe');

$MForm->addSelectField("9.category_ids", $categories, [
    'title' => 'Standard: Alle Kategorien',
    'multiple' => true,
    'size' => 1,
    'class' => "form-control selectpicker",
    "data-live-search" => "true"
])->setLabel('Auf Kategorien beschränken');

// optional. Anzahl der Beiträge pro Seite

$MForm->addInputField('number', '9.limit',
[
    'min' => 1,
    'max' => 100,
    'step' => 1,
    'placeholder' => 'Standard: 12',
], 12)->setLabel('Anzahl der Beiträge pro Seite');


echo $MForm->show();
