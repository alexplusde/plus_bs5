<?php

// ######################################################################
// Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
// Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die
// Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
// ######################################################################

if (!bs5::packageExists('media_manager_responsive')) {
    return;
}

$mform = MForm::factory();

$mform->addFieldsetArea('');

$mform->addTextField(1, ['label' => 'translate:headline']);

$mform->addSelectField(2, ['h1' => 'Seite',
    'h2' => 'Ebene 2',
    'h3' => 'Ebene 3',
    'h4' => 'Ebene 4'], ['label' => 'Ebene']);

$mform->addTextAreaField(3, ['label' => 'Teaser', 'class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addTextAreaField(8, ['label' => 'CTA', 'class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addLinkListField(2, ['label' => 'Artikel']);
$mform->addAlertInfo('Kategorie Info');

$mform->addMediaField(2, ['label' => 'Hintergrundbild (Desktop)']);
$mform->addMediaField(3, ['label' => 'Hintergrundbild (mobile)']);

echo $mform->show();
