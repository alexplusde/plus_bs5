<?php

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

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
