<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content_editor $this */

use Alexplusde\BS5\Helper;
use Alexplusde\Events\Category;
use Alexplusde\BS5\MForm as BS5MForm;

/* Addon-Prüfung */
$requiredAddons = ['yform', 'events'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Die Veranstaltungen werden in REDAXO über den Menüpunkt 'Termine' verwaltet.", Helper::getBackendPageLink('events'));

// optional. Kategorien des Addons "Neues" als MForm-Select-Feld
$categories = [];
Category::getAll()->filter(function ($category) use (&$categories) {
    $categories[$category->id] = $category->name;
});

$MForm = new BS5MForm();

$MForm->addSelectField("9.category_ids", $categories, [
    'multiple' => true,
    'size' => 1,
    'class' => "form-control selectpicker",
    "data-live-search" => "true"
]);

// optional. Anzahl der Beiträge pro Seite

$MForm->addInputField('number', '9.limit',
[
    'min' => 1,
    'max' => 100,
    'step' => 1,
], 12);


echo $MForm->show();
