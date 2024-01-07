<?php

if (rex_addon::get('yform') && rex_addon::get('yform')->isAvailable()) {
    rex_yform::addTemplatePath(rex_path::addon('plus_bs5', 'yformtemplates'));
}

if (rex::isBackend() && rex::isDebugMode() && rex_config::get('plus_bs5', 'dev')) {
    bs5::writeModule();
    bs5::writeTemplate();
}
