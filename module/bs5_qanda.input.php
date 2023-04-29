<?php

$mform = MForm::factory();

$qanda_categories = qanda_company::query()->find();
$options = [];
foreach ($qanda_categories as $qanda_company) {
    $options[$qanda_company->getId()] = $qanda_company->getName();
}

$field = $mform->addMultiSelectField(1, $options);
$field->setLabel('translate:test');

$qandas = qanda::query()->find();
$options = [];
foreach ($qandas as $qanda) {
    $options[$qanda->getId()] = $qanda->getQuestion();
}

$field = $mform->addMultiSelectField(2, $options);
$field->setLabel('translate:test');
// parse form
echo $mform->show();
