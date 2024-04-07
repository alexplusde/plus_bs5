<div class="modal fade h-100" id="mobileNavigation">
	<div class="modal-dialog modal-lg" tabindex="-1" aria-hidden="true"
		aria-labelledby="{{template-header-mobile-navigation.menu}}">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">{{template.header-mobile-navigation.title}}</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="template.header-mobile-navigation.close"></button>
			</div>
			<div class="modal-body">

				<?= bs5_mobile_navigation::getNav(rex_config::get('plus_bs5', 'nav_depth', 1))?>

			</div>
			<div class="modal-footer">

				<?php

                $footer_nav = explode(',', rex_config::get('plus_bs5', 'footer_navigation'));
                foreach ($footer_nav as $id) {
                    $article = rex_article::get($id);
                    if ($article) {?>
				<a href="<?= $article->getUrl() ?>"
					class="text-muted"><?= $article->getName() ?>
				</a>

				<?php }
                    } ?>
			</div>
		</div>
	</div>
</div>
