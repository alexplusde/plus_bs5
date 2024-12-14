<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use rex_sql;

$reviews = rex_sql::factory()->getArray('SELECT * FROM rex_feeds_item WHERE content_raw = 5 ORDER BY rand() LIMIT 3') ?>
?>
<!-- BEGIN plus_bs5/fragments/bs5/feeds/index-google_places.php -->
<div class="container py-5">
	<div class="title my-3">
		<h2>Das sagen unsere Kunden</h2>
	</div>
	<div class="card-group">

		<?php foreach ($reviews as $review) { ?>

			<div class="card">
				<div class="card-body">
					<h3 class="h5 card-title">
						<?= $review['author'] ?>
					</h3>
					<p>⭐⭐⭐⭐⭐</p>
					<p class="text">
						<?= nl2br($review['content']) ?>
					</p>
				</div>

				<div class="card-footer">
					<small class="text-muted">Quelle: <a
							href="<?= $review['url'] ?>"
							target="_blank">Google Maps</a>, verfasst am
						<?php $date = new \DateTime($review['date']);
						echo $date->format('d.m.Y') ?></small>
				</div>
			</div>


		<?php } ?>

	</div>

</div>
<!-- END plus_bs5/fragments/bs5/feeds/index-google_places.php -->
