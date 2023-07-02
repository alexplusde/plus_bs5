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

$mform->addSelectField(2, ['h1' => 'Seitentitel', 
'h2' => 'Überschrift 2', 
'h3' => 'Überschrift 3', 
'h4' => 'Überschrift 4'], ['label' => 'Ebene']);

$mform->addTextAreaField(3, ['label' => 'Teaser','class' => rex_config::get('plus_bs5', 'editor')]);

$mform->addMediaListField(2, array('label'=>'Downloads'));

$mform->addMediaField(2, array('label'=>'Hintergrundbild (Desktop)'));
$mform->addMediaField(3, array('label'=>'Hintergrundbild (mobile)'));

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField("9.layout", ['list' => 'Liste', 
'cols' => 'mehrspaltig (ohne Vorschau)', 
'cols-image' => 'mehrspaltig (mit Vorschau)'], ['label' => 'Layout']);

$mform->addSelectField("9.cols", [
    1 => '1 Download / Spalte', 
    2 => '2 Download / Spalte', 
    3 => '3 Download / Spalte', 
    4 => '4 Download / Spalte', 
    5 => '5 Download / Spalte', 
    6 => '6 Download / Spalte'], ['label' => 'Einteilung']);
echo $mform->show();