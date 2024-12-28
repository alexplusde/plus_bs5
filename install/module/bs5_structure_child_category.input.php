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
$requiredAddons = ['mform', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* MForm-Formular */
$mform = new MForm();
$mform->addFieldsetArea('');

/** Kategorien inkl. Unterkategorien als Array ausgeben */
$root = rex_category::getRootCategories();
$options =  [];
$options = ['' => 'Aktuelle Kategorie'];
foreach ($root as $cat) {
    $options[$cat->getId()] = $cat->getName();
    $subcats = $cat->getChildren(true);
    foreach ($subcats as $subcatId => $subcat) {
        $options[$subcatId] = "↳ ". $subcat->getName();
    }
}

$mform->addSelectField(1, $options, array('label'=>'Kategorie wählen (optional)'));

echo $mform->show();
