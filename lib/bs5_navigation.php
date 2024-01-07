<?php

class bs5_navigation extends rex_navigation
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

                if (1 == $depth && $category->getChildren()) {
                    $li['class'][] = 'dropdown';
                    $a['class'][] = 'dropdown-toggle';
                    $a['data-bs-toggle'][] = 'dropdown';
                    $a['href'][] = '#';
                    $a['role'][] = 'button';
                    $a['aria-expanded'][] = 'false';
                }

                if (2 == $depth) {
                    $a['class'][] = 'dropdown-item';
                }

                return true;
            });
        }
        $navi->addCallback(static function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            $li['class'][] = 'nav-item';
            $a['class'][] = 'btn';
            $a['class'][] = 'nav-link';

            if ('Jobs' == $a_content) {
                $a_content .= ' <span class="badge rounded-pill bg-danger border border-light">' . count(stellenangebote::findOnline(0)) . '<span class="visually-hidden"> Jobangebote</span><span>';
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
