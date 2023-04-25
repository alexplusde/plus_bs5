<section class="modul modul-text bs5-categories">
	<div
		class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
		<div class="container text-center">
			<div class="row row-cols-1 row-cols-md-3 g-4">

				<?php $articles  = rex_category::getCurrent()->getArticles();

		foreach($articles as $article) {
		    ?>
				<div class="col">
					<div class="card h-100">
						<div class="card-body">
							<h3 class="card-title">
								<?= $article->getName() ?>
							</h3>
							<p class="card-text">
								<?= $article->getValue('yrewrite_description') ?>
							</p>
							<a href="<?= $article->getUrl(); ?>"
								class="btn btn-primary">More...</a>
						</div>
					</div>
				</div>
				<?php
		}
		?>
			</div>
		</div>
	</div>
</section>
