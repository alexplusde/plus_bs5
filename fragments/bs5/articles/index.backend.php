<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */

?>
<!-- BEGIN plus_bs5/fragments/bs5/articles/index.backend.php -->
 <div class="row row-cols-1 row-cols-md-2 g-4">
	<?php
    $articles = $this->getVar('articles');

	foreach ($articles as $article) {
	    if (1 != $article->getValue('status')) {
	        continue;
	    }
	    if ($article->isStartArticle()) {
	        continue;
	    }
	    ?>
		<div class="col mb-3">
			<div class="card h-100">
				<div class="card-body">
					<h3 class="card-title h5">
						<?= $article->getName() ?>
					</h3>
					<p class="card-text">
						<?= $article->getValue('yrewrite_description') ?>
					</p>
				</div>
				<div class="card-footer text-end">
					<a href="<?= $article->getUrl() ?>"
						class="btn btn-primary">Mehr...</a>
				</div>

			</div>
		</div>
	<?php
	}
	?>
</div>
<!-- END plus_bs5/fragments/bs5/articles/index.backend.php -->
