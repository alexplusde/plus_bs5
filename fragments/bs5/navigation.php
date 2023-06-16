<div class="d-flex flex-column flex-shrink-0 p-3 bg-light sticky-lg-top h-100">
	<a href="<?= rex_article::getCurrent()->getCategory()->getUrl() ?>"
		class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
		<span class="fs-4">
			< {{bs5.navigation.back}}</span>
	</a>
	<hr>
	<?= bs5_subnavigation::getNav() ?>
</div>