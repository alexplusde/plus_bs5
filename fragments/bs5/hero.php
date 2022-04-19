<section data-rex-module="" data-rex-slide="" class="bs5-hero">
    <?php
    echo media_manager_type_group::getBackgroundStyles($this->getVar('image'), "bs5_title", "#bs5-hero-bg-image");
    ?>
    <div class="w-100 bg-white" id="bs5-hero-bg-image" style="background-size: cover; background-position: center">
        <div class="container mx-auto">
            <div class="bs5-hero--container py-5 col-12 col-md-6">
                <div class="bs5-hero--headline my-1 py-3 px-4">
                    <h1 class="d-inline-block"><?= $this->getVar('title') ?>
                    </h1>
                </div>
                <div class="bs5-hero--teaser container mx-0 py-3 px-5 my-1">
                    <p class="lead fw-normal"><?= $this->getVar('teaser') ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="divider p-5"
            style="background-image: url(/media/msg-divider-title.svg); background-position: bottom right; background-size: cover; background-repeat: no-repeat;">
        </div>
    </div>
</section>