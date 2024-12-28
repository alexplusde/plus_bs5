<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\Fragment;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'wenns_sein_muss'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Für die Ausgabe auf der Website muss der WSM Consent Manager aktiviert sein.");

/* Fragment */
$fragment = new Fragment();
$fragment->setVar('slice_id', "REX_SLICE_ID");
$fragment->setVar('article_id', "REX_ARTICLE_ID");

/* Modulspezifische Variablen */
$fragment->setVar('video', "REX_MEDIA[1]");
$fragment->setVar('thumbnail', "REX_MEDIA[2]");
$fragment->setVar('options', "REX_VALUE[10]");

/* Ausgabe */
echo $fragment->parse('bs5/video_mediapool/index.php');

?>
