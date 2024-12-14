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
