<?php

if (!rex_addon::get('qanda') && !rex_addon::get('qanda')->isAvailable()) {
    echo rex_view::error(rex_i18n::bpk('bs5-install-qanda'));
};
