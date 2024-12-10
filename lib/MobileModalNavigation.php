<?php

namespace Alexplusde\BS5;

use rex_article;
use rex_category;
use rex_yrewrite;
use rex_clang;
use rex_string;

class MobileModalNavigation
{
    public static function getNav($level = 1)
    {
        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();

        if ($mount_id && rex_category::get($mount_id)) {
            $root = rex_category::get($mount_id)->getChildren(true);
        } else {
            $root = rex_category::getRootCategories();
        }

        $output = [];

        $div = [];
        $div['class'] = 'list-group';

        $output[] = '<div ' . rex_string::buildAttributes($div) . '>';

        foreach ($root as $category) {

            $a = [];
            if (!$category->isOnline()) {
                continue;
            }

            if (\rex_plugin::get('ycom', 'auth') && \rex_plugin::get('ycom', 'auth')->isAvailable()) {
                continue;
            }

            if ('|mobile_hidden|' == $category->getValue('cat_nav')) {
                $a['class'] = 'd-lg-none';
            }

            $title = $category->getName();

            if (rex_category::getCurrent()->getId() == $category->getId()) {
                $a['class'][] = 'active';
            }

            $a['href'] = $category->getUrl();
            $a['class'][] = 'list-group-item list-group-item-action';
            $output[] = '<a ' . rex_string::buildAttributes($a) . '>' . $title . '</a>';

        }

        $output[] = '</div>';

        return implode('', $output);
    }
}
