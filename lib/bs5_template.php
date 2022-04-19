<?php

class bs5_template
{
    public static function getNav()
    {
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
}
