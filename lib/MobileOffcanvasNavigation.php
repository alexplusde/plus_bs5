<?php

namespace Alexplusde\BS5;

use rex_article;
use rex_category;
use rex_clang;
use rex_plugin;
use rex_string;
use rex_yrewrite;

use function in_array;

class MobileOffcanvasNavigation
{
    public static function getNav($level = 2)
    {
        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();

        if ($mount_id && rex_category::get($mount_id)) {
            $root = rex_category::get($mount_id)->getChildren(true);
        } else {
            $root = rex_category::getRootCategories(true);
        }

        $output = [];

        $ul = [];
        $ul['class'] = 'navbar-nav justify-content-end flex-grow-1 pe-3';

        $output[] = '<ul ' . rex_string::buildAttributes($ul) . '>';

        foreach ($root as $category) {
            $li = [];
            $a = [];
            $a_content = '';

            if (rex_plugin::get('ycom', 'auth') && rex_plugin::get('ycom', 'auth')->isAvailable()) {
                continue;
            }

            if (str_contains($category->getValue('cat_nav'), '|mobile_hidden|')) {
                continue;
            }

            $li['class'][] = 'nav-item';
            $a['class'][] = 'nav-link';
            if (in_array($category->getId(), rex_article::getCurrent()->getPathAsArray())) {
                $a['class'][] = 'active';
            }
            if ($category->getChildren(true) && $level > 1) {
                // Dropdown-Klassen hinzufügen
                $li['class'][] = 'dropdown';
                $a['class'][] = 'dropdown-toggle';
                $a['role'] = 'button';
                $a['data-bs-toggle'] = 'dropdown';
                $a['aria-expanded'] = 'false';
                $a['href'] = '#';
            } else {
                $a['href'] = $category->getUrl();
            }

            $a_content = $category->getName();

            if (rex_category::getCurrent()->getId() == $category->getId()) {
                $a['class'][] = 'active';
            }
            if ($category->getId() === rex_article::getCurrent()->getId()) {
                $a['aria-current'] = 'page';
            }

            $output[] = '<li ' . rex_string::buildAttributes($li) . '>';
            $output[] = '<a ' . rex_string::buildAttributes($a) . '>' . $a_content . '</a>';

            if ($level > 1) {
                $output[] = self::getSubNav($category, $level);
            }
        }

        $output[] = '</ul>';

        return implode('', $output);
    }

    public static function getSubNav(rex_category $parentCategory)
    {
        $output = [];
        $ul = [];
        $ul['class'][] = 'dropdown-menu w-100';
        $ul['data-bs-popper'] = 'static';

        $output[] = '<ul ' . rex_string::buildAttributes($ul) . '>';
        $categories = $parentCategory->getChildren(true);
        $current_category = rex_category::getCurrent();

        if ($parentCategory->isOnline()) {
            array_unshift($categories, $parentCategory);
        }

        foreach ($categories as $category) {
            $li = [];
            $a = [];
            $a_content = '';

            if (str_contains($category->getValue('cat_nav'), '|mobile_hidden|')) {
                continue;
            }

            $a_content = $category->getName();
            $li['class'][] = '';
            $a['class'][] = 'dropdown-item';
            $a['href'] = $category->getUrl();

            if ($category->getId() === rex_article::getCurrent()->getId()) {
                $a['class'][] = 'active';
                $a['aria-current'] = 'page';
            }

            if ($category->getId() == $parentCategory->getId()) {
                $output[] = '<li ' . rex_string::buildAttributes($li) . '>';
                $output[] = '<a ' . rex_string::buildAttributes($a) . '>' . $a_content . ' - Übersicht</a>';
                $output[] = '</li>';
                $output[] = '<li><hr class="dropdown-divider"></li>';
                continue;
            }

            $output[] = '<li ' . rex_string::buildAttributes($li) . '>';
            $output[] = '<a ' . rex_string::buildAttributes($a) . '>' . $a_content . '</a>';
            $output[] = '</li>';
        }

        $output[] = '</ul>';
        return implode('', $output);
    }
}
