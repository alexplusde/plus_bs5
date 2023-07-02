<section class="modul modul-text bs5-categories">
	<div
		class="container <?= rex_config::get('plus_bs5', 'container_class') ?>">
		<div class="container text-center">
			<div class="row row-cols-1 row-cols-md-3 g-4">

				<?php $categories = rex_category::getCurrent()->getChildren();

        foreach ($categories as $category) {
            ?>
				<div class="col">
					<div class="card h-100">
						<img src="..." class="card-img-top" alt="...">
						<div class="card-body">
							<h3 class="card-title">
								<?= $category->getName() ?>
							</h3>
							<p class="card-text">
								<?= $category->getValue('yrewrite_description') ?>
							</p>
							<a href="<?= $category->getUrl() ?>"
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
