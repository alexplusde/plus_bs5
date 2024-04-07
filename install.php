<?php

bs5::updateModule();
bs5::updateTemplate();

if (rex_addon::get('metainfo')->isAvailable()) {
    rex_metainfo_add_field('translate:cat_nav', 'cat_nav', '100', '', 5, '||', 'desktop_hidden:translate:plus_bs5_nav_desktop_hidden');
}
