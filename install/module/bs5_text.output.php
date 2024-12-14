<?php

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['school', 'mform'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/** Variablen */
$modul = rex_var::toArray("REX_VALUE[1]");
$modul_yform = rex_var::toArray("REX_VALUE[2]");

/* Fragment */
$fragment = new Fragment();
$fragment->setVar('slice_id', "REX_SLICE_ID");
$fragment->setVar('article_id', "REX_ARTICLE_ID");

/* Modulspezifische Variablen */
$fragment->setVar('headline' , "REX_VALUE[1]");
$fragment->setVar('headline_level' , "REX_VALUE[2]");
$fragment->setVar('text' , "REX_VALUE[4 output=html]", false);
$fragment->setVar('cta' , "REX_VALUE[8 output=html]", false);
$fragment->setVar('image' , "REX_MEDIA[1]");

/* Ausgabe */
echo $fragment->parse('bs5/text/index.php');

?>
