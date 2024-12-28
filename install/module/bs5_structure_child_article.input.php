<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'mediapool', 'media_manager', 'media_manager_responsive', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Dieser Block verwendet standardmäßig die aktuelle Kategorie, um deren enthaltene Artikel anzuzeigen. Wählen Sie eine andere Kategorie aus, um die Artikel einer anderen Kategorie anzuzeigen.");

Helper::showBackendUserA18yInstruction("Für Barrierefreiheit beachten, den untergeordneten Artikeln einen aussagekräftigen Titel und einen Teaser-Text zu geben.");

/* MForm-Formular */
$mform = new MForm();
$mform->addFieldsetArea('Kategorie auswählen');

/** Kategorien inkl. Unterkategorien als Array ausgeben */
$root = rex_category::getRootCategories();
$options =  [];
foreach ($root as $cat) {
    $options[$cat->getId()] = $cat->getName();
    $subcats = $cat->getChildren(true);
    foreach ($subcats as $subcat) {
        $options[$cat->getId()][$subcat->getId()] = '   '.$subcat->getName();
    }
}

$mform->addSelectField(1, $options, array('label'=>'(optional)'));

echo $mform->show();
