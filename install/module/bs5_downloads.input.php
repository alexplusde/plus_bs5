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
$mform = Mform::defaultFactory(1,2,3);

$mform->addMedialistField(1, array('label'=>'Downloads'));

echo $mform->show();
