<div class="p-5"></div>
<footer class="pt-5 bg-white shadow">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<?= rex_config::get('plus_bs5', 'footer_text') ?>
			</div>
			<div class="col-md-3">
				<?= rex_config::get('plus_bs5', 'imprint') ?>
			</div>

			<div class="col-md-3">
				<p><strong>Weitere Infos</strong></p>
				<ul class="nav flex-column">
					<?php
                                    $footer_nav = explode(',', rex_config::get('plus_bs5', 'footer_navigation'));
                foreach ($footer_nav as $id) {
                    $article = rex_article::get($id);
                    if ($article) {?>

					<li class="nav-item mb-2">
						<a href="<?= $article->getUrl() ?>"
							class="nav-link p-0 text-muted"><?= $article->getName() ?>
						</a>
					</li>
					<?php }
                    } ?>
				</ul>
			</div>

			<div class="col-md-3">
			</div>
		</div>

		<div class="d-flex justify-content-between py-4 border-top">
			<p><?= domain::getCurrent()->getName() ?>
			</p>
			<ul class="list-unstyled d-flex">
				<li class="ms-3"><a class="link-dark" href="#"></a></li>
				<li class="ms-3"><a class="link-dark" href="#"></a></li>
				<li class="ms-3"><a class="link-dark" href="#"></a></li>
			</ul>
		</div>
	</div>
</footer>
