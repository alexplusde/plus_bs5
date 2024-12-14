<?php

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

/* Ausgabe */
echo $fragment->parse('bs5/neues/index.php');
