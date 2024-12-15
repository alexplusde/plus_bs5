<?php
#######################################################################
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
# Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
#######################################################################

if (!bs5::packageExists('media_manager_responsive')) {
    return;
};

$output = new bs5_fragment();
$output->setVar("slice_id", "REX_SLICE_ID");
$output->setVar("article_id", "REX_ARTICLE_ID");
$output->setVar("modul_name", "REX_MODULE_KEY");

/* REX_MEDIA */
$output->setVar("divider_image", "REX_MEDIA[2]");
$output->setVar("divider_image_mobile", "REX_MEDIA[3]");

/* Options */
$output->setVar("options", rex_var::toArray("REX_VALUE[9]"));

if(rex::isFrontend()) {
    echo $output->parse("REX_MODULE_KEY");
} else {
    echo $output->parse("REX_MODULE_KEY".".backend");    
}


unset($output);
