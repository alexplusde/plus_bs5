<?php

if (\rex_addon::get('yform') && \rex_addon::get('yform')->isAvailable()) {
    rex_yform::addTemplatePath(rex_path::addon('plus_bs5', 'yformtemplates'));
}

if (rex::isBackend() && rex::isDebugMode() && rex_config::get('plus_bs5', 'dev')) {
    Helper::writeModule();
    Helper::writeTemplate();
}

/** OutputFilter Replace '<table>' with '<table class="table">' */

rex_extension::register('OUTPUT_FILTER', function (rex_extension_point $ep) {
    $subject = $ep->getSubject();
    $search = '<table>';
    $replace = '<table class="table">';
    $subject = str_replace($search, $replace, $subject);
    $ep->setSubject($subject);
});
