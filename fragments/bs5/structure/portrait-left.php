<?php

$structure = $this->getVar('structure');
?>
<div class="col">
    <div class="card h-100">

        <div class="row g-0">
            <div class="col-md-4">

                <?php
            $media = rex_media_plus::get($structure->getValue('yrewrite_image'));

            if ($media) { ?>
                <img src="<?= $media->getUrl() ?>" class="card-img-top"
                    alt="<?= $structure->getName() ?>">
                <?php } ?> </div>

            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">
                        <?= $structure->getName() ?>
                    </h3>
                    <p class="card-text">
                        <?= $structure->getValue('yrewrite_description') ?>
                    </p>
                    <a href="<?= $structure->getUrl() ?>" class="btn btn-primary"><?= Helper::getConfigText('text_more') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
