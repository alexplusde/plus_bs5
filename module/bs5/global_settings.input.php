<?php

$mform = MForm::factory();

$sql_options = rex_sql::factory()->getArray("SELECT title, CONCAT(name) as value FROM rex_global_settings_field ORDER BY title");
$options = [];
foreach($sql_options as $sql_option) {
    $options[$sql_option['value']] = $sql_option['title'];
}


$field = $mform->addSelectField(1, $options);
$field->setLabel('translate:test');


// parse form
echo $mform->show();
