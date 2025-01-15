<?php

namespace Alexplusde\BS5;

include __DIR__ . '/lib/Helper.php';

use Alexplusde\BS5\Helper;
use Tracks\🦖;
use rex_addon;
use rex_config;

🦖::forceBackup('plus_bs5');
🦖::updateModule('plus_bs5');
🦖::updateTemplate('plus_bs5');

if (rex_addon::get('metainfo') && rex_addon::get('metainfo')->isAvailable()) {
    rex_metainfo_add_field('translate:plus_bs5.metainfo.cat_nav', 'cat_nav', '100', '', 5, '||', 'desktop_hidden:translate:plus_bs5_nav_desktop_hidden');
    rex_metainfo_add_field('translate:plus_bs5.metainfo.cat_is_button', 'cat_is_button', '100', '', 4, '', ':translate:plus_bs5.metainfo.cat_is_button.none|btn-primary:translate:plus_bs5.metainfo.cat_is_button.primary|btn-secondary:translate:plus_bs5.metainfo.cat_is_button.secondary');
    rex_metainfo_add_field('translate:plus_bs5.metainfo.clang_locale', 'clang_locale', '100', '', 1, '|"de_DE.utf8","de_DE","de"|', '');
}

rex_config::set("search_it", "plaintext_selectors", "head,script,link,header,footer,styles,[data-search_it=\"noindex\"]");

/** @var rex_addon $redactor */
$redactor = rex_addon::get('redactor');

if($redactor && $redactor->isAvailable()) {
    include(__DIR__ . '/install/redactor-profile.php');
}

if (rex_addon::get('yrewrite') && rex_addon::get('yrewrite')->isAvailable()) {
    include(__DIR__ . '/install/yrewrite_meta_info.domain.php');
}

rex_delete_cache();
