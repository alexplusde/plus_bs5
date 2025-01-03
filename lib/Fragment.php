<?php

namespace Alexplusde\BS5;

use rex;
use rex_fragment;

use function strlen;

class Fragment extends rex_fragment
{
    const BACKEND_SUFFIX = '.backend.php';

    public function parse($fragment_frontend)
    {
        if (rex::isBackend()) {
            try {
                $output = parent::parse(self::addBackendSuffix($fragment_frontend));
            } catch (\InvalidArgumentException $e) {
                $output = parent::parse(self::addSuffix($fragment_frontend));
            }
        } else {
            $output = parent::parse(self::addSuffix($fragment_frontend));
        }
        return $output;
    }

    public function show($fragment_frontend, $fragment_backend = null)
    {
        echo self::parse($fragment_frontend, $fragment_backend);
    }

    public static function addSuffix($filename = '', $suffix = '.php')
    {
        if (substr($filename, -strlen($suffix)) !== $suffix) {
            return $filename . $suffix;
        }
        return $filename;
    }

    public function parseSubfragment($fragment_frontend)
    {
        if (rex::isBackend()) {
            try {
                return parent::getSubfragment(self::addBackendSuffix($fragment_frontend));
            } catch (\InvalidArgumentException $e) {
                return parent::getSubfragment(self::addSuffix($fragment_frontend));
            }
        }
        return parent::parse(self::addSuffix($fragment_frontend));
    }

    public function showSubfragment($fragment_frontend)
    {
        echo $this->parseSubfragment($fragment_frontend);
    }

    public static function addBackendSuffix($filename = '')
    {
        // entferne `.php` Suffix
        $filename = preg_replace('/\.php$/', '', $filename);
        return self::addSuffix($filename, self::BACKEND_SUFFIX);
    }

    public static function ctaFormatter($text = '')
    {
        if($text === '' || $text === null) {
            return '';
        }
        $pattern = ['/<a([^>]*)><strong>([^<>]*)<\/strong><\/a>/', '/<a([^>]*)><em>([^<>]*)<\/em><\/a>/', '/<a (?!class)([^>]*)>([^<>]*)<\/a>/'];
        $replace = ['<a class="btn btn-primary" $1>$2</a>', '<a class="btn btn-secondary" $1>$2</a>', '<a class="btn btn-white" $1>$2</a>'];
        return preg_replace($pattern, $replace, $text);
    }

    public static function badgeFormatter($text = '')
    {
        if($text === '') {
            return '';
        }
        $pattern = ['/<u>([^<>]*)<\/u>/'];
        $replace = ['<span class="badge rounded-pill bg-primary">$1</span>'];
        return preg_replace($pattern, $replace, $text);
    }
}
