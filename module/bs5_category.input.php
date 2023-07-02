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

$mform->addHtml('<div class="row"><div class="col col-12 col-md-9">');

$mform->addTextField(1, ['label' => 'Überschrift']);
$mform->addDescription('Geben Sie eine Überschrift ein.');

$mform->addHtml('</div><div class="col col-12 col-md-3">');

$mform->addSelectField(2, ['h1' => 'Seite',
    'h2' => 'Ebene 2',
    'h3' => 'Ebene 3',
    'h4' => 'Ebene 4'], ['label' => 'Ebene']);
$mform->addDescription('Barrierefreiheit: Ordnen Sie den Inhalt einer Ebene zu.');

$mform->addHtml('</div></div>');

$mform->addTextAreaField(3, ['label' => 'Teaser', 'class' => 'redactor-editor--bs5_teaser']);

$mform->addTextAreaField(8, ['label' => 'CTA', 'class' => 'redactor-editor--bs5_cta']);
$mform->addDescription('optional: Text eingeben und verlinken, um Aktions-Buttons hinzuzufügen.');

$mform->addLinkField(1, ['label' => 'Kategorie']);
$mform->addDescription('optional: Startartikel auswählen, aus dessen untergeordneter Kategorien ausgewählt wird.');

$mform->addMediaField(2, ['label' => 'Hintergrundbild (Desktop)']);
$mform->addMediaField(3, ['label' => 'Hintergrundbild (mobile)']);

$mform->addSelectField('9.layout', ['no-image' => 'Nur Text',
    'landscape-top' => 'Bild (Querformat) oben',
    'portrait-top' => 'Bild (Hochformat) oben',
    'portrait-left' => 'Bild (Hochformat) links',
    'landscape-inside' => 'Bild (Querformat) als Hintergrund'], ['label' => 'Layout']);

echo $mform->show();
