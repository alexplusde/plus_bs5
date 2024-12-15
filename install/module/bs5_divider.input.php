<?php

use FriendsOfRedaxo\MForm;
#######################################################################
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
# Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
#######################################################################

if (!bs5::packageExists('media_manager_responsive')) {
  return;
};

$mform = MForm::factory();

$mform->addFieldsetArea('');

$mform->addMediaField(2, array('label'=>'Bild (Desktop)'));
$mform->addMediaField(3, array('label'=>'Bild (mobile)'));

$mform->addFieldsetArea('Darstellung');

$mform->addSelectField("9.layout", ['full-width' => 'Volle Breite', 
'container' => 'Standard'], ['label' => 'Layout']);

echo $mform->show();
