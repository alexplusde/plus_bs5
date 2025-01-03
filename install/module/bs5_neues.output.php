<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['yform', 'neues'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Die Veranstaltungen werden in REDAXO über den Menüpunkt 'Aktuelles' verwaltet.", Helper::getBackendPageLink('neues'));

/* Fragment */
$fragment = new Fragment();
$fragment->setVar('slice_id', "REX_SLICE_ID");

/* Modulspezifische Variablen */
$fragment->setVar('headline' , "REX_VALUE[1]");
$fragment->setVar('headline_level' , "REX_VALUE[2]");
$fragment->setVar('teaser' , "REX_VALUE[3 output=html]", false);

$options = rex_var::toArray("REX_VALUE[9]");
$fragment->setVar('category_ids', $options['category_ids'] ?? []);
$fragment->setVar('limit', $options['limit'] ?? 12);

/* Ausgabe */
echo $fragment->parse('bs5/neues/index.php');
