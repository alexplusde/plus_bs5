<?php

/**
 * Dieses Modul wird über das Addon school verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['yform', 'school'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Fragment */
$fragment = new Fragment();
$fragment->setVar('slice_id', "REX_SLICE_ID");
$fragment->setVar('article_id', "REX_ARTICLE_ID");

/* Modulspezifische Variablen */
$fragment->setVar('content', rex_var::toArray("REX_VALUE[1]"));

echo $fragment->parse('bs5/accordion/index.php');
