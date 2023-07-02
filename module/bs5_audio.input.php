<?php

// ######################################################################
// Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
// Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die
// Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
// ######################################################################

if (!bs5::packageExists('redactor, media_manager_responsive')) {
    return;
}

$mform = MForm::factory();

$mform->addFieldsetArea('');

$mform->addTextField(1, ['label' => 'translate:headline']);

$mform->addSelectField(2, ['h1' => 'Überschrift 1',
    'h2' => 'translate:Überschrift 2',
    'h3' => 'Überschrift 3',
    'h4' => 'Überschrift 4'], ['label' => 'translate:headline_level']);

$mform->addTextAreaField(3, ['label' => 'Teaser', 'class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addMediaField(1, ['label' => 'Poster']);
$mform->addMediaField(2, ['label' => 'Hintergrundbild (Desktop)']);
$mform->addMediaField(3, ['label' => 'Hintergrundbild (mobile)']);
$mform->addMediaField(4, ['label' => 'Audio']);

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField(9, ['full-width' => 'Volle Breite',
    'container' => 'Standard',
    'text-video' => 'Text rechts, Audio links',
    'video-text' => 'Audio links, Text rechts'], ['label' => 'Layout']);
echo $mform->show();
