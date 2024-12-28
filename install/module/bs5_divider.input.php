<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content_editor $this */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'wenns_sein_muss'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

$mform = MForm::factory();

$mform->addFieldsetArea('');

$mform->addMediaField(2, array('label'=>'Bild (Desktop)'));
$mform->addMediaField(3, array('label'=>'Bild (mobile)'));

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField(9, ['full-width' => 'Volle Breite', 
'container' => 'Standard'], ['label' => 'Layout'], 1);

echo $mform->show();
