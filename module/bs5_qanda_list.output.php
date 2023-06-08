<?php
#######################################################################
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
# Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
#######################################################################

if (!bs5::packageExists('mform, qanda')) {
    return;
};

$output = new bs5_fragment();
$output->setVar("slice_id", "REX_SLICE_ID");
$output->setVar("article_id", "REX_ARTICLE_ID");
$output->setVar("modul_name", "REX_MODULE_KEY");

$output->setVar("category_ids", rex_var::toArray(REX_VALUE[5 output=html]));
$output->setVar("question_ids", rex_var::toArray(REX_VALUE[6 output=html]));

echo $output->parse("REX_MODULE_KEY", "REX_MODULE_KEY".".backend");

unset($output);
