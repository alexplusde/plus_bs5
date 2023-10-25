<section class="modul modul-text bs5-articles">
	<div class="container <?= rex_config::get('plus_bs5', 'container_class') ?>">
		<div class="row row-cols-1 row-cols-md-3 g-4 m-0">

			<?php
$category = rex_category::get($this->getVar('category'));
if (!$category) {
$category = rex_category::getCurrent();
}
$articles = $parent->getArticles();

foreach ($articles as $article) {
if (1 != $article->getValue('status')) {
continue;
}

$this->setVar('parent', $parent);
$this->setVar('structure', $article);

echo $this->subfragment('bs5/structure/' . $layout . '.php');

}
?>
		</div>
	</div>
</section>
