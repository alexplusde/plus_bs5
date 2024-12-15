<?php

/**
 * Dieses Modul wird über das Addon school verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

use Alexplusde\BS5\Helper;
use FriendsOfRedaxo\MForm;

/* Benötigte Addons */
$requiredAddons = ['yform', 'school'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* MForm */
$mform = new MForm();

// Tab-Navigations-Elemente: Tab-Name, Tab-Inhalt
$mform->addTextField('name', ['label' => 'Name']);
$mform->addTextField('headline', ['label' => 'Überschrift']);
$mform->addTextAreaField('content', ['label' => 'Inhalt', 'class' => 'form-control redactor-editor--text']);

$repeater = MForm::factory();
$repeater->addRepeaterElement(1, $mform);

echo $repeater->show();
