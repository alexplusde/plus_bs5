<?php

class bs5_fragment extends rex_fragment
{
    public function parse($fragment_frontend, $fragment_backend = null)
    {
        if ($fragment_backend && rex::isBackend()) {
            return parent::parse($fragment_parent);
        }
        return parent::parse($fragment_frontend);
    }
    public function show($fragment_frontend, $fragment_backend = null)
    {
        echo self::parse($fragment_frontend, $fragment_backend);
    }
}
