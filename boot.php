<?php

namespace Alexplusde\BS5;

use rex_addon;
use rex_config;
use rex_extension;
use rex_yform;
use rex;
use rex_be_page;
use rex_category;
use rex_extension_point;
use rex_path;
use rex_response;

if (rex_addon::get('yform') && rex_addon::get('yform')->isAvailable()) {
    rex_yform::addTemplatePath(rex_path::addon('plus_bs5', 'yformtemplates'));
}

if (rex::isBackend() && rex::isDebugMode() && rex_config::get('plus_bs5', 'dev')) {
    Helper::setIndicators();
    Helper::writeModule();
    Helper::writeTemplate();
}

/** OutputFilter Replace '<table>' with '<table class="table">' */

if (rex::isFrontend()) {
    rex_extension::register('OUTPUT_FILTER', static function (rex_extension_point $ep) {
        $subject = $ep->getSubject();
        $search = '<table>';
        $replace = '<table class="table table-responsive">';
        $subject = str_replace($search, $replace, $subject);
        $ep->setSubject($subject);
    });
}

if (rex::isBackend() && count(\rex_category::getRootCategories()) === 1 && \rex_be_controller::getCurrentPagePart(1) === 'structure' && \rex_be_controller::getCurrentPagePart(2) === '') {
    if (rex_get('category_id', 'int', 0) === 0 && rex_get('clang', 'int', 0) === 0) {
        rex_response::sendRedirect(\rex_url::backendPage('structure', ['category_id' => \rex_category::getRootCategories()[0]->getId()], false));
    }

}

$clang = \rex_clang::getCurrent();
setlocale(LC_ALL, $clang->getValue('locale'), $clang->getCode());

$addon = rex_addon::get('plus_bs5');
$addon->setProperty('css', []);
