<?php

$addon = rex_addon::get('plus_bs5');
$addon->setProperty('is_update', true);

include(__DIR__ . '/install.php');
