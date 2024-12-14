<?php

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'wenns_sein_muss'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Um an den nötigen Paramter zu kommen, sind folgende Schritte nötig: 1. Google Maps öffnen. 2 Eintrag suchen. 3. \"Teilen\" anklicken. 4. \"Karte einbetten\" anklicken. 5. iframe-Code kopieren. 6. Den Wert des Parameters \"pb=\" kopieren.");

/* MForm-Formular */
$mform = new MForm();
$mform->addTextField(1, array('label'=>'pb='));

echo $mform->show();
?>
