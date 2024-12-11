<?php

namespace Alexplusde\BS5;

use rex_article;
use rex_category;
use rex_clang;
use rex_navigation;
use rex_plugin;
use rex_yrewrite;

use function in_array;

class Navigation extends rex_navigation
{
    protected function getListTag(array $items, array $ul, int $depth): string
    {
        if (1 == $depth) {
            $ul['class'][] = 'navbar-nav nav w-100 justify-content-end';
        }
        if (2 == $depth) {
            $ul['class'][] = 'dropdown-menu';
        }

        return parent::getListTag($items, $ul, $depth);
    }

    public static function getNav($level = 2)
    {
        $navi = self::factory();

        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();

        $navi->addCallback(static function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            if ('|desktop_hidden|' == $category->getValue('cat_nav')) {
                $li['class'][] = 'd-lg-none';
            }
            return true;
        });

        if ($level > 1) {
            $navi->addCallback(static function (rex_category $category, $depth, &$li, &$a, &$a_content) {
                if ('|desktop_hidden|' == $category->getValue('cat_nav')) {
                    return false;
                }

                $a['class'][] = 'btn nav-link';

                if (1 == $depth && $category->getChildren(true)) {
                    $li['class'][] = 'dropdown btn-group nav-item';

                    // Wenn aktuelle Kategorie ausgewählt ist oder Parent der aktuell ausgewählten Kategorie ist (sich im Path befindet)
                    if (in_array($category->getId(), rex_article::getCurrent()->getPathAsArray())) {
                        $a['class'][] = 'btn-outline-primary';
                    } else {
                        $a['class'][] = 'pr-0';
                    }
                    $a['aria-expanded'][] = 'false';
                    $a_content .= ' </a><a role="button" class="btn dropdown-toggle dropdown-toggle-split ms-0" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Mehr anzeigen</span></a>';
                }

                if (2 == $depth) {
                    $a['class'][] = 'dropdown-item';
                }

                return true;
            });
        }
        $navi->addCallback(static function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            if ($depth > 1) {
                $li['class'][] = 'nav-item';
                $a['class'][] = 'btn';
                $a['class'][] = 'nav-link';
            }

            // active-Klasse, wenn aktuell ausgewählte Kategorie
            if ($category->getId() == rex_article::getCurrent()->getCategoryId()) {
                $li['class'][] = 'active';
            }

            return true;
        });

        if (rex_plugin::get('ycom', 'auth') && rex_plugin::get('ycom', 'auth')->isAvailable()) {
            $navi->addCallback('rex_ycom_auth::articleIsPermitted');
        }

        $output = $navi->get($mount_id, $level, true, true);

        return $output;
    }
}
