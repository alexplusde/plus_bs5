<?php

/** @var rex_fragment $this */

namespace FriendsOfRedaxo\Neues;

use rex_media_plus;
use Url\Url;

// versuche die Url aufzulösen
$manager = Url::resolveCurrent();
if ($manager) {
    /** @var Entry $entry */
    $entry = $manager->getDataset();
    ?>
	<div class="row">
		<div class="col-xl-8">
			<div class="mb-3">
				<?= $this->getSubfragment('bs5/neues/list-back.php') ?>
			</div>
			<p><?= $entry->getFormattedPublishDateTime() ?>
			</p>
			<h1><?= $entry->getName() ?></h1>
			<p class="category-badges">
				<?php
                    $categories = $entry->getCategories();
    foreach ($categories as $category) {
        ?>
					<span
						class="badge bg-primary"><?= $category->getName() ?></span>
				<?php
    }
    ?>
			</p>
			<p class="teaser">
				<?= $entry->getTeaser() ?>
			</p>
		</div>

		<div class="col-12 col-xl-4">
			<div class="image">
				<?php
    $image = $entry->getImage();
    $media = rex_media_plus::get($image);
    if ($media) {
        echo $media->setClass('img-fluid')->getImg('');
    }
    ?>
			</div>
		</div>
	</div>

		<div class="entry row g-4">

			<div class="col-md-8 mt-5">
				<?= $entry->getDescription() ?>
			</div>
			<div class="col-md-8">
			</div>
		</div>

		<?= $this->getSubfragment('bs5/neues/list-back.php') ?>
<?php

}
?>
