<?php

// ######################################################################
// Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
// Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die
// Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
// ######################################################################

if (!bs5::packageExists('media_manager_responsive')) {
    return;
}

$output = new bs5_fragment();
$output->setVar('slice_id', 'REX_SLICE_ID');
$output->setVar('article_id', 'REX_ARTICLE_ID');
$output->setVar('name', 'REX_MODULE_KEY');

/* REX_VALUE */
$output->setVar('title', 'REX_VALUE[1 output=html]');
$output->setVar('level', 'REX_VALUE[2 output=html]');
$output->setVar('teaser', 'REX_VALUE[3 output=html], false');
$output->setVar('cta', 'REX_VALUE[8 output=html]');

/* REX_MEDIA */
$output->setVar('bg_image', 'REX_MEDIA[2]');
$output->setVar('bg_image_mobile', 'REX_MEDIA[3]');

/* REX_LINK */
$output->setVar('category', 'REX_LINK[1]');

/* Zusätzliche Layout-Einstellungen */
$output->setVar('options', rex_var::toArray('REX_VALUE[9]'));

echo $output->parse('REX_MODULE_KEY');

unset($output);
