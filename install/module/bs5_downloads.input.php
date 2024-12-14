<?php

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'mediapool', 'media_manager', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Legacy-Modus: Die Werte der Eingabefelder müssen in das untenstehende Formular übertragen werden.");

Helper::showBackendUserA18yInstruction("Für Barrierefreiheit beachten, im Medienpool den Titel des Downloads und ggf. eine Beschreibung zu setzen.");

Helper::showBackendUserA18yInstruction("Für Barrierefreiheit den Inhalt der Downloads, wenn möglich, direkt auf die Website stellen, statt als PDF/DOCX/PPTX.");

/* MForm-Formular */
$mform = new MForm();

$mform->addFieldsetArea('Teaser');

$mform->addTextField("1.title", array('label'=>'Eigene Überschrift'));
$mform->addCheckboxField("1.show_title", array(1=>'ja'), array('label'=>'anzeigen?'))->setDefaultValue(1);

$mform->addTextAreaField("1.teaser", array('label'=>'Teaser','class'=>'redactor-editor--mini'));

$mform->addMedialistField(1, array('label'=>'Downloads'));

echo $mform->show();
