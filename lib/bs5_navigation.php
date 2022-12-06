<?php

class bs5_navigation extends rex_navigation
{
    protected function getListTag(array $items, array $ul, int $depth): string
    {
        if ($depth == 1) {
            $ul['class'][] = "navbar-nav nav w-100 justify-content-end";
        }
        if ($depth == 2) {
            $ul['class'][] = "dropdown-menu";
        }
        return parent::getListTag($items, $ul, $depth);
    }

    public static function getNav($level = 2)
    {
        $navi = bs5_navigation::factory();

        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();
        
        $navi->addCallback(function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            if ($category->getValue('cat_nav') == "|desktop_hidden|") {
                $li['class'][] = 'd-lg-none';
            }
            return true;
        });

        if ($level > 1) {
            $navi->addCallback(function (rex_category $category, $depth, &$li, &$a, &$a_content) {
                if ($category->getValue('cat_nav') == "|desktop_hidden|") {
                    return false;
                }

                if ($depth == 1 && $category->getChildren()) {
                    $li['class'][] = 'dropdown';
                    $a['class'][] = 'dropdown-toggle';
                    $a['data-bs-toggle'][] = 'dropdown';
                    $a['href'][] = '#';
                    $a['role'][] = 'button';
                    $a['aria-expanded'][] = 'false';
                }

                if ($depth == 2) {
                    $a['class'][] = 'dropdown-item';
                }
                
                return true;
            });
        }
        $navi->addCallback(function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            $li['class'][] = 'nav-item';
            $a['class'][] = 'btn';
            $a['class'][] = 'nav-link';

            return true;
        });
    

        if (\rex_plugin::get('ycom', 'auth') && \rex_plugin::get('ycom', 'auth')->isAvailable()) {
            $navi->addCallback('rex_ycom_auth::articleIsPermitted');
        }

        $output = $navi->get($mount_id, $level, true, true);

        return $output;
    }
};
