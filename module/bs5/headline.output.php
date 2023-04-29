<?php
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO

if (!bs5::packageExists('')) {
    return;
};

$output = new bs5_fragment();
$output->setVar("slice_id", "REX_SLICE_ID");
$output->setVar("article_id", "REX_ARTICLE_ID");
$output->setVar("name", "REX_MODULE_KEY");

$output->setVar("title", "REX_VALUE[1]", false);
$output->setVar("teaser", "REX_VALUE[2 output=html]", false);

/* REX_MEDIA */
$output->setVar("image", "REX_MEDIA[id=1]");

echo $output->parse("REX_MODULE_KEY");

unset($output);
