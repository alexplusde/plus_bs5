<?php

class bs5_fragment extends rex_fragment
{
    public function parse($fragment_frontend, $fragment_backend = '')
    {
        if ('' !== $fragment_backend && rex::isBackend()) {
            return parent::parse(self::addSuffix($fragment_backend));
        }
        return parent::parse(self::addSuffix($fragment_frontend));
    }

    public function show($fragment_frontend, $fragment_backend = null)
    {
        echo self::parse($fragment_frontend, $fragment_backend);
    }

    public static function addSuffix($filename = '', $suffix = '.php')
    {

        if (substr($filename, -strlen($suffix)) !== $suffix) {
            return $filename.$suffix;
        }
        return $filename;
    }

    public static function ctaFormatter($text)
    {
        $pattern = ['/<a([^>]*)><strong>([^<>]*)<\/strong><\/a>/', '/<a([^>]*)><em>([^<>]*)<\/em><\/a>/', '/<a (?!class)([^>]*)>([^<>]*)<\/a>/'];
        $replace = ['<a class="btn btn-primary" $1>$2</a>', '<a class="btn btn-secondary" $1>$2</a>', '<a class="btn btn-white" $1>$2</a>'];
        return preg_replace($pattern, $replace, $text);
    }
    
    public static function badgeFormatter($text)
    {
        $pattern = ['/<u>([^<>]*)<\/u>/'];
        $replace = ['<span class="badge rounded-pill bg-primary">$1<span>'];
        return preg_replace($pattern, $replace, $text);
    }
}
