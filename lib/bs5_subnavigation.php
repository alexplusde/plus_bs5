<?php

class bs5_subnavigation extends rex_navigation
{
    protected function getListTag(array $items, array $ul, int $depth): string
    {
        if (1 == $depth) {
            $ul['class'][] = 'nav nav-pills flex-column mb-auto';
        }
        return parent::getListTag($items, $ul, $depth);
    }

    public static function getNav($level = 1, $category = null)
    {
        $navi = bs5_navigation::factory();

        if ($parent = rex_article::getCurrent()->getCategory()->getParent()) {
            $parent_id = $parent->getId();
        } else {
            $parent_id = rex_article::getCurrent()->getCategory()->getId();
        }

        $navi->addCallback(static function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            $li['class'][] = 'nav-item';
            $a['class'][] = 'nav-link';

            return true;
        });

        if (\rex_plugin::get('ycom', 'auth') && \rex_plugin::get('ycom', 'auth')->isAvailable()) {
            $navi->addCallback('rex_ycom_auth::articleIsPermitted');
        }

        $output = $navi->get($parent_id, $level, true, true);

        return $output;
    }
}
