<?php
#######################################################################
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
# Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
#######################################################################

if (!bs5::packageExists('mform, redactor')) {
  return;
};

$mform = MForm::factory();

$mform->addTextAreaField(8, ['label' => 'CTA','class' => "form-control redactor-editor--bs5_cta"]);

echo $mform->show();