<header class="bg-white sticky-top border-bottom">

	<div class="header-top bg-primary text-white link-light py-2">
		<div class="container">
			<div class="row">
				<?= bs5::getConfig('header_text');  ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row py-3 align-items-center">
			<div class="col-6 col-lg-3"><a class="d-block logo max-height: 60px;" href="/"
					title=""><?= rex_media_plus::get("logo.svg")->getImg();?></a>
			</div>
			<div class="d-lg-block col-3 col-lg-9">
				<nav id="navbar_main" class="mobile-offcanvas nav-main navbar navbar-expand-lg">
					<div class="offcanvas-header">
						<button class="btn-close float-end"></button>
					</div>
					<div class=" navbar-collapse" id="navbarSupportedContent">
						<?= bs5_navigation::getNav(rex_config::get('plus_bs5', 'nav_depth', 1)); ?>
					</div>
				</nav>
			</div>
			<div class="col-3 d-block d-lg-none text-end">
				<button data-trigger="navbar_main" class="d-lg-none btn btn-outline-primary" type="button"><i
						class="bi bi-list"></i> Menü
				</button>
			</div>
		</div>
	</div>
</header>
