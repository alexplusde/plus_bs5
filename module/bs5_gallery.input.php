<?php
#######################################################################
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
# Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
#######################################################################

if (!bs5::packageExists('redactor, media_manager_responsive')) {
  return;
};

$mform = MForm::factory();

$mform->addFieldsetArea('');

$mform->addTextField(1, ['label' => 'translate:headline']);

$mform->addSelectField(2, ['h1' => 'Überschrift 1', 
'h2' => 'translate:Überschrift 2', 
'h3' => 'Überschrift 3', 
'h4' => 'Überschrift 4'], ['label' => 'translate:headline_level']);

$mform->addTextAreaField(3, ['label' => 'Teaser','class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addMediaListField(1, array('label'=>'Bilder'));

$mform->addMediaField(2, array('label'=>'Hintergrundbild (Desktop)'));
$mform->addMediaField(3, array('label'=>'Hintergrundbild (mobile)'));

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField("9.layout", ['container-list' => 'Liste', 
'container-slideshow' => 'Slideshow', 
'fullwidth-list' => 'Liste (volle Breite)',
'fullwidth-slideshow' => 'Slideshow (volle Breite)'], ['label' => 'Layout']);

$mform->addSelectField("9.lightbox", [
    true => 'Bilder per Klick vergrößern', 
false => 'Bilder nicht vergrößern'], ['label' => 'Zoom']);

$mform->addSelectField("9.cols", [
    1 => '1 Bild / Spalte', 
    2 => '2 Bilder / Spalte', 
    3 => '3 Bilder / Spalte', 
    4 => '4 Bilder / Spalte', 
    5 => '5 Bilder / Spalte', 
    6 => '6 Bilder / Spalte'], ['label' => 'Einteilung']);
echo $mform->show();