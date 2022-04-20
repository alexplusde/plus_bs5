<?php

class bs5_template
{
    public static function getNav()
    {
        return self::getNavNav();

        $navi = rex_navigation::factory();

        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();

        $navi->addCallback(function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            $li['class'][] = 'nav-item';
            $a['class'][] = 'nav-link';

            if ($category->getValue('cat_nav') == "|desktop_hidden|") {
                return false;
            }
            return true;
        });

        // $navi->addCallback('rex_ycom_auth::articleIsPermitted');

        $output = $navi->get($mount_id, 1, true, true);

        $pattern = '/<ul class="rex-navi1.*-elements">/i';
        $output = preg_replace($pattern, '', $output);

        return $output;
    }
    public static function getNavNav()
    {
        $navi = rex_navigation::factory();

        $mount_id = rex_yrewrite::getDomainByArticleId(rex_article::getCurrentId(), rex_clang::getCurrentId())->getMountId();

        $navi->addCallback(function (rex_category $category, $depth, &$li, &$a, &$a_content) {
            $li['class'][] = 'nav-item';
            $a['class'][] = 'btn';
            $a['class'][] = 'nav-link';

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

            if ($category->getValue('cat_nav') == "|desktop_hidden|") {
                return false;
            }
            return true;
        });

        // $navi->addCallback('rex_ycom_auth::articleIsPermitted');

        $output = $navi->get($mount_id, 2, true, true);

        $pattern = '/<ul class="rex-navi1.*-elements">/i';
        $output = preg_replace($pattern, '', $output);
        $pattern = '/(<ul class="rex-navi2.)(.*)(-elements">)/i';
        $output = preg_replace($pattern, '$1 dropdown-menu $2$3', $output);

        return $output;
    }
}
