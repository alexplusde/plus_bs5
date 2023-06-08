<?php 

$structure = $this->getVar('structure'); 
?>
<div class="col">
    <div class="card h-100">
        <div class="card-body">
            <h3 class="card-title">
                <?= $structure->getName() ?>
            </h3>
            <p class="card-text">
                <?= $structure->getValue('yrewrite_description') ?>
            </p>
            <a href="<?= $structure->getUrl(); ?>"
                class="btn btn-primary"><?= bs5::getConfigText('text_more'); ?></a>
        </div>
    </div>
</div>
