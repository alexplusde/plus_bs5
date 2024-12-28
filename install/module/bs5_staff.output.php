<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

use Alexplusde\BS5\Helper;

if (!Helper::packageExists(['staff'], ['yform'], ['url'])) {
    return;
};

use Alexplusde\School\Team;
use Url\Url;

$manager = Url::resolveCurrent();

if ($manager) {
    $person = Team::get($manager->getDatasetId()); ?>

<div class="container bg-white p-3">
	<div class="row row-cols-1 row-cols-md-2 g-4">
		<div class="col">
			<h2><?= $person->getValue('fullname') ?>
			</h2>
			<p class="text">
				<?= $person->getValue('content'); ?>
			</p>
		</div>
	</div>
</div>

<?php
} else { // Übersicht?>
<section class="bs5_team_list">
	<div class="container p-3">
		<div class="row row-cols-1 row-cols-md-2 g-4">

			<?php

$team = team::query()->find();

    foreach ($team as $person) {
        ?>
			<div class="col">

				<div class="card h-100 shadow bg-white">
					<div class="row g-0">
						<div class="col-12 col-md-4">
							<img src="/media/addon_team_portrait/<?= $person->getValue('image') ?>"
								class="img-fluid rounded-start d-none d-md-block"
								alt="<?= $person->getValue('fullname') ?>">

							<img src="/media/addon_team_square/<?= $person->getValue('image') ?>"
								class="img-fluid d-md-none w-100"
								alt="<?= $person->getValue('fullname') ?>">
						</div>
						<div class="col-12 col-md-8">
							<div class="card-body">
								<h2 class="card-title">
									<?= $person->getValue('fullname') ?>
								</h2>
								<p class="card-text">
									<?= $person->getValue('description') ?>
								</p>
								<p class="card-text"><a
										href="<?= rex_getUrl('', '', ['team-id' => $person->getId()])?>"><span>Vita</span></a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
    }

    ?>
		</div>
	</div>
</section>
<?php }
?>
