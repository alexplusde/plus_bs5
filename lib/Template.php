<?php

namespace Alexplusde\BS5;

use rex_path;
use rex_url;

class Template
{
    public static function getAssetUrl($file, $show_timestamp = true)
    {
        if ($show_timestamp) {
            $timestamp = '?timestamp=' . filemtime(rex_path::assets($file));
        }

        return rex_url::assets($file) . $timestamp;
    }
}
