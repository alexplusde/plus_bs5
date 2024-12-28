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

/* Modulspezifische Variablen */
/*@ TODO @alxndr-w: Hier die Daten aus dem Modul einfügen */ 
/*
$pattern = '/pb=([^&]+)/';
preg_match($pattern, $code, $matches);
$pb = $matches[1];
echo $pb;
*/

$fragment->setVar('data_id', "REX_VALUE[1]");

/* Ausgabe */
echo $fragment->parse('bs5/google_maps/index.php');

?>
