<?php

use Alexplusde\BS5\Helper;
use Alexplusde\School\Team;
use FriendsOfRedaxo\MForm;


$requiredAddons = ['school', 'mform'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

Helper::showBackendUserInstruction("Dieses Modul befindet sich im Legacy-Modus und sollte durch ein normales Text-Modul ersetzt werden.");

/* MForm */
$mform = new MForm();

// Tab-Navigations-Elemente: Tab-Name, Tab-Inhalt
$mform->addTextField('name', ['label' => 'Name']);
$mform->addTextField('headline', ['label' => 'Überschrift']);
$mform->addTextAreaField('content', ['label' => 'Inhalt']);

$repeater = MForm::factory();
$repeater->addRepeaterElement(1, $mform);

echo $repeater->show();
