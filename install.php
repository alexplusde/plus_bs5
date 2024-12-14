<?php

include __DIR__ . '/lib/Helper.php';

use Alexplusde\BS5\Helper;

Helper::updateModule();
Helper::updateTemplate();
Helper::forceBackup();

if (rex_addon::get('metainfo') && rex_addon::get('metainfo')->isAvailable()) {
    rex_metainfo_add_field('translate:plus_bs5.metainfo.cat_nav', 'cat_nav', '100', '', 5, '||', 'desktop_hidden:translate:plus_bs5_nav_desktop_hidden');
    rex_metainfo_add_field('translate:plus_bs5.metainfo.clang_locale', 'clang_locale', '100', '', 1, '|"de_DE.utf8","de_DE","de"|', '');
}
