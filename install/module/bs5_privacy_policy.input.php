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
$requiredAddons = ['mform', 'redactor', 'wenns_sein_muss'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* MForm-Formular */
$mform = MForm::defaultFactory(1,2,4);

// MForm-Auswahl, ob Consent-Modal oder Consent-Settings beim Klick auf den Button angezeigt werden soll
$mform->addSelectField('8', ['modal' => 'Modal', 'settings' => 'Einstellungen']);
$mform->setLabel('Button-Verhalten');

echo $mform->show();
