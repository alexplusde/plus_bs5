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

$mform->addHtml('<div class="row"><div class="col col-12 col-md-9">');
$mform->addTextField(1, ['label' => 'Überschrift']);

$mform->addHtml('</div><div class="col col-12 col-md-3">');

$mform->addSelectField(2, ['h1' => 'Seite',
    'h2' => 'Ebene 2',
    'h3' => 'Ebene 3',
    'h4' => 'Ebene 4'], ['label' => 'Ebene']);

$mform->addHtml('</div></div>');

$mform->addTextAreaField(3, ['label' => 'Teaser', 'class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addMediaField(1, ['label' => 'Bild']);
$mform->addMediaField(2, ['label' => 'Hintergrundbild (Desktop)']);
$mform->addMediaField(3, ['label' => 'Hintergrundbild (mobile)']);

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField('9.layout', ['full-width' => 'Volle Breite',
    'container' => 'Standard',
    'text-image' => 'Text links, Bild rechts',
    'image-text' => 'Bild links, Text rechts'], ['label' => 'Layout']);
echo $mform->show();
