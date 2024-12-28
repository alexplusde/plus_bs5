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
$requiredAddons = ['mform', 'wenns_sein_muss'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Um an den nötigen Paramter zu kommen, sind folgende Schritte nötig: 1. YouTube-Video öffnen. 2. in der Adresszeile die ID kopieren (z.B. https://www.youtube.com/watch?v=<strong>dQw4w9WgXcQ</strong>).");

/* MForm-Formular */
$mform = new MForm();
$mform->addFieldsetArea("Youtube Video");
$mform->addTextField(1, array('label'=>'Youtube-ID'));

$mform->addMediaField(2, array('label'=>'Vorschaubild (optional)'));

echo $mform->show();
