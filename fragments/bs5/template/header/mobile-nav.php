<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use rex_config;
use Fragment;

if ('offcanvas' == rex_config::get('plus_bs5', 'mobile_nav_layout')) {
    echo $this->parse('bs5/template/header/mobile-nav-offcanvas.php');
} else {
    echo $this->parse('bs5/template/header/mobile-nav-modal.php');
}
