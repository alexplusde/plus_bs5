<?= $this->getSubfragment("bs5/template/header-mobile-navigation.php") ?>
<header class="bg-white sticky-top border-bottom">

	<div class="header-top bg-primary text-white link-light py-2">
		<div class="container">
			<div class="row">
				<?= bs5::getConfig('header_text');  ?>
			</div>
		</div>
	</div>
	<?php
?>
	<div class="container">
		<div class="row py-3 align-items-center">
			<div class="col-9 col-lg-3"><a class="d-block logo max-height: 60px;" href="/"
					title=""><?= rex_media_plus::get(domain::getCurrent()->getLogo())->getImg();?></a>
			</div>
			<div class="d-none d-lg-block col-3 col-lg-9">
				<nav id="navbar_main" class="nav-main navbar navbar-expand-lg">
					<div class="navbar-collapse">
						<?= bs5_navigation::getNav(rex_config::get('plus_bs5', 'nav_depth', 1)); ?>
					</div>
				</nav>
			</div>
			<div class="col-3 d-block d-lg-none text-end">

				<button class="d-lg-none btn btn-primary" type="button" data-bs-target="#mobileNavigation"
					data-bs-toggle="modal">
					<i class="bi bi-list"></i>&nbsp;Menü</button>

			</div>
		</div>
	</div>
</header>
