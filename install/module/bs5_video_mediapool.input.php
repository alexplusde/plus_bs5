<?php

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

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
