<?php

namespace Alexplusde\BS5;

use FriendsOfRedaxo\Maintenance\Maintenance;
use FriendsOfRedaxo\YrewriteMetainfo\Domain;
use rex_config;
use rex_media_plus;

/** @var \Fragment $this */
?>
<!--    <a class="visually-hidden visually-hidden-focusable" href="#content">Zum Inhalt springen</a>-->
<?= $this->getSubfragment('bs5/template/header/mobile-nav.php') ?>
<header class="bg-white sticky-top border-bottom">

	<div class="header-top bg-primary text-white link-light py-2">
		<div class="container">
			<div class="row">
				<?= Maintenance::showAnnouncement() ?>
				<?= Helper::getConfig('header_text')  ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row py-3 align-items-center">
			<div class="col-9 col-lg-2 pr-0"><a class="d-block logo" style="max-height: 55px;" href="/"
					title=""><?= rex_media_plus::get(Domain::getCurrent()->getLogo())->setClass('img-fluid')->getImg() ?></a>
			</div>
			<div class="d-none d-lg-block col-3 col-lg-10 px-0">
				<nav id="navbar_main" class="nav-main navbar navbar-expand-lg">
					<div class="navbar-collapse">
						<?= Navigation::getNav(rex_config::get('plus_bs5', 'nav_depth', 1)) ?>
					</div>
				</nav>
			</div>
			<div class="col-3 d-block d-lg-none text-end">
<?php

if ('offcanvas' == rex_config::get('plus_bs5', 'mobile_nav_layout')) {
    echo $this->parse('bs5/template/header/mobile-nav-button-offcanvas.php');
} else {
    echo $this->parse('bs5/template/header/mobile-nav-button-modal.php');
}

?>

			</div>
		</div>
	</div>
</header>
