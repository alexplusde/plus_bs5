<?php
$layout = $this->getVar('options')['layout'] ?? 'no-image';
?>
<section class="modul modul-text bs5-category">
	<div class="container <?= rex_config::get('plus_bs5', 'container_class') ?>">
			<div class="row row-cols-1 row-cols-md-3 g-4 m-0">

				<?php
        $parent = rex_category::get($this->getVar('category'));
        if (!$parent) {
            $parent = rex_category::getCurrent();
        }
        $categories = $parent->getChildren();

        foreach ($categories as $category) {
            if (1 != $category->getValue('status')) {
                continue;
            }

            $this->setVar('parent', $parent);
            $this->setVar('structure', $category);

            echo $this->subfragment('bs5/structure/'.$layout.'.php');

        }
        ?>
			</div>
	</div>
</section>
