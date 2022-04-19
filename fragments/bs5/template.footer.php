<footer class="pt-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?= rex_global_settings::getValue('footer_text'); ?>
            </div>
            <div class="col-md-3">
                <?= rex_global_settings::getValue('footer_contact'); ?>
            </div>

            <div class="col-md-3">
                <p><strong>Menü</strong></p>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Start</li>
                </ul>
            </div>

            <div class="col-md-3">
            </div>
        </div>

        <div class="d-flex justify-content-between py-4 border-top">
            <p><?= domain::getCurrent()->getName(); ?>. Alle
                Rechte
                vorbehalten.
            </p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-dark" href="#"></a></li>
                <li class="ms-3"><a class="link-dark" href="#"></a></li>
                <li class="ms-3"><a class="link-dark" href="#"></a></li>
            </ul>
        </div>
    </div>
</footer>