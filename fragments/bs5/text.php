<section class="modul modul-text bs5-text">
    <div
        class="container <?= rex_config::get("plus_bs5", "container_class") ?>">
        <?php if ($this->getVar('content') !== "") { ?>
        <?= $this->getVar('content') ?>
        <?php } else {
    ?>
        <?= bs5::getLoremIpsumText(); ?>
        <?php
} ?>
    </div>
</section>