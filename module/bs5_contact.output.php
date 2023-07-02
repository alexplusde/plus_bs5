<?php

// Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
// Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO

if (!bs5::packageExists('feeds', 'google_places')) {
    return;
}

$output = new bs5_fragment();
$output->setVar('slice_id', 'REX_SLICE_ID');
$output->setVar('article_id', 'REX_ARTICLE_ID');
$output->setVar('name', 'REX_MODULE_KEY');

echo $output->parse('REX_MODULE_KEY');

unset($output);
