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
Helper::showBackendUserInstruction("Lade ein MP4-Video in den Medienpool hoch. Empfohlene Einstellungen für MP4-Daten: MPEG4-Dateien mit H.264 Video-Codec + AAC Audio-Codec)");

/* MForm-Formular */
$mform = new MForm();
$mform->addFieldsetArea("Youtube Video");
$mform->addMediaField(1, array('label'=>'MP4-Video'));
$mform->addMediaField(2, array('label'=>'Vorschaubild (optional)'));
$mform->addMultiSelectField(10, array('label'=>'Optionen', 'options' => ['autoplay' => 'Autoplay', 'loop' => 'Loop', 'muted' => 'Muted']));

echo $mform->show();
