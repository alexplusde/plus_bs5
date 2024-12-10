<?php

namespace Alexplusde\BS5;

/** @var \rex_fragment $this */

use rex_config;

if(rex_config::get('plus_bs5', 'mobile_nav_layout') == 'offcanvas') {
	echo $this->parse('bs5/template/header/mobile-nav-offcanvas.php');
} else {
	echo $this->parse('bs5/template/header/mobile-nav-modal.php');
}

?>
