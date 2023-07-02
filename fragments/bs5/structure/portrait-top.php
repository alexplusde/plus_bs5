<?php

$structure = $this->getVar('structure');
?>
<div class="col">
    <div class="card h-100">
        <div class="card-body">

						<?php
                        $media = rex_media_plus::get($structure->getValue('yrewrite_image'));
                        if ($media) { ?>
						<img src="<?= $media->getUrl() ?>" class="card-img-top" alt="<?= $structure->getName() ?>">
						<?php } ?>
            <h3 class="card-title">
                <?= $structure->getName() ?>
            </h3>
            <p class="card-text">
                <?= $structure->getValue('yrewrite_description') ?>
            </p>
            <a href="<?= $structure->getUrl() ?>"
                class="btn btn-primary"><?= bs5::getConfigText('text_more') ?></a>
        </div>
    </div>
</div>
