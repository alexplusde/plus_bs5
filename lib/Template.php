<?php

namespace Alexplusde\BS5;

use rex_addon;

class Template
{
    public static function addCss(array $css): void
    {
        $addon = rex_addon::get('plus_bs5');
        $styles = $addon->getProperty('css') ?? [];
        $styles[$css['href']] = $css;
        $addon->setProperty('css', $styles);
    }

    public static function showCss(): void
    {
        $addon = rex_addon::get('plus_bs5');
        $css = $addon->getProperty('css') ?? [];
        foreach ($css as $c) {
            echo '<link '.\rex_string::buildAttributes($c ?? []).' rel="stylesheet" type="text/css">';
        }
    }

    /* $js['defer'] = true; */
    public static function addJs(array $js): void
    {
        $addon = rex_addon::get('plus_bs5');
        $javascript = $addon->getProperty('js') ?? [];
        $javascript[$js['src']] = $js;
        $addon->setProperty('js', $javascript);
    }

    public static function showJs(): void
    {

        $addon = rex_addon::get('plus_bs5');
        $js = $addon->getProperty('js') ?? [];
     
           foreach ($js as $j) {
            echo '<script '.\rex_string::buildAttributes($j ?? []).'></script>';
        }
    }

}
