<?php

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'mediapool', 'media_manager', 'media_manager_responsive', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Legacy-Modus: Die Werte der Eingabefelder müssen in das untenstehende Formular übertragen werden.");

Helper::showBackendUserA18yInstruction("Für Barrierefreiheit beachten, im Medienpool den Titel des Downloads und ggf. eine Beschreibung zu setzen.");

/* MForm-Formular */
$mform = new MForm();

$mform->addFieldsetArea('Teaser');

$mform->addTextField("1.title", array('label'=>'Eigene Überschrift'));
$mform->addCheckboxField("1.show_title", array(1=>'ja'), array('label'=>'anzeigen?'))->setDefaultValue(1);

$mform->addTextAreaField("1.teaser", array('label'=>'Einleitung','class'=>'redactor-editor--text', 'id'=>'redactor_1'));

$mform->addMedialistField(1, array('label'=>'Galerie'));
$mform->addSelectField("1.gallery_mode", array('max'=>'Vollbild','grid'=>'Raster','slide'=>'Slideshow'), array('label'=>'Modus'));

echo $mform->show();
