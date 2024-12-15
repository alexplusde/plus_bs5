<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* MForm-Formular */
$mform = MForm::defaultFactory(1,2,4);

$mform->addSelectField(9, ['primary' => 'primary',  
    'secondary' => 'secondary', 
    'success' => 'success', 
    'danger' => 'danger', 
    'warning' => 'warning', 
    'info' => 'info', 
    'light' => 'light', 
    'dark' => 'dark'
], ['label' => 'Typ']);

echo $mform->show();
