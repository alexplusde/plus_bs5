<?php

namespace Alexplusde\BS5;

/** @var \Fragment $this */

use FriendsOfRedaxo\YrewriteMetainfo\Domain;
use rex_media_plus;

?>
<header class="bg-white sticky-top border-bottom">

	<div class="header-top bg-primary text-white link-light py-2">
		<div class="container">
			<div class="row">
				<?= Helper::getConfig('header_text')  ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row py-3 align-items-center">
			<div class="col-6 col-lg-3"><a class="d-block logo max-height: 60px;" href="/"
					title=""><?= rex_media_plus::get(Domain::getCurrent()->getLogo())->getImg()?></a>
			</div>
			<div class="d-lg-block col-3 col-lg-9">
			</div>
			<div class="col-3 d-block d-lg-none text-end">
			</div>
		</div>
	</div>
</header>
