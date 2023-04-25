<?php

class bs5_fragment extends rex_fragment
{
    public function parse($fragment_frontend, $fragment_backend = "")
    {
        if ($fragment_backend !== "" && rex::isBackend()) {
            return parent::parse(self::addSuffix($fragment_backend));
        }
        return parent::parse(self::addSuffix($fragment_frontend));
    }
    public function show($fragment_frontend, $fragment_backend = null)
    {
        echo self::parse($fragment_frontend, $fragment_backend);
    }
    
    public static function addSuffix($filename = "", $suffix = ".php")
    {

        if(substr($filename, -strlen($suffix)) !== $suffix) {
            return $filename.$suffix;
        }
        return $filename;
    }
}
