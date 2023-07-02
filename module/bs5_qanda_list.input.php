<?php

// ######################################################################
// Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
// Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die
// Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
// ######################################################################

if (!bs5::packageExists('mform, qanda')) {
    return;
}

$mform = MForm::factory();

// REX_VALUE[id=5] - Kategorie-Filter #

$qanda_categories = qanda_category::query()->find();
$options = [];
foreach ($qanda_categories as $qanda_company) {
    $options[$qanda_company->getId()] = $qanda_company->getName();
}

$field = $mform->addMultiSelectField(5, $options);
$field->setLabel('translate:bs/qanda/list_select_category_label');

$qandas = qanda::query()->find();
$options = [];
foreach ($qandas as $qanda) {
    $options[$qanda->getId()] = $qanda->getQuestion();
}

// REX_VALUE[id=6] - Fragen-Filter #

$field = $mform->addMultiSelectField(6, $options);
$field->setLabel('translate:bs/qanda/list_select_question_label');

echo $mform->show();
