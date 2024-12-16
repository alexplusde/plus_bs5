<?php

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['search_it'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Für die Suchfunktion wird ein aktueller Index der Seite im Add-on 'search_it' benötigt.", Helper::getBackendPageLink('search_it'));

$fragment = new Fragment();

/* Suchergebnisse */
echo $fragment->parse('bs5/search_it/index.php');

?>
