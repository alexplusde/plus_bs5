<?php

class bs5_template
{
    public static function getAssetUrl($file, $show_timestamp = true)
    {
        if ($show_timestamp) {
            $timestamp = '?timestamp='.filectime(rex_path::assets($file));
        }

        return rex_url::assets($file) . $timestamp;
    }
}
