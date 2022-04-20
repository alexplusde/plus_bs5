<section class="rex-module rex-module-bs5_video">
    <div
        class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
        <div class="ratio ratio-16x9">
            <iframe
                src="<?= $this->getVar('url') ?>"
                title="<?= $this->getVar('title') ?>"
                allowfullscreen></iframe>
        </div>
    </div>
</section>