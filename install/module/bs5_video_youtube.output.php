<?php

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
$fragment->setVar('data_id', "REX_VALUE[1]");
$fragment->setVar('data_thumbnail', "REX_MEDIA[1]");

/* Ausgabe */
echo $fragment->parse('bs5/video_youtube/index.php');

?>
