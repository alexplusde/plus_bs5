<?php

namespace Alexplusde\BS5;

use rex_article;

/** @var \rex_fragment $this */
?>
<div class="d-flex">
	<aside id="nav">
		<?php
    $output = new Fragment();
        echo $output->parse('bs5/template/navigation.php');

        ?>
	</aside>

	<main id="content" class="content min-vh-100 w-100">
		<?php if ('|1|' == rex_article::getCurrent()->getValue('art_intro')) {
            $output = new Fragment();

            $output->setVar('title', rex_article::getCurrent()->getName(), false);
            $output->setVar('teaser', rex_article::getCurrent()->getValue('yrewrite_description'), false);

            /* REX_MEDIA */
            $output->setVar('image', rex_article::getCurrent()->getValue('art_image'));

            echo $output->parse('bs5/hero.php');
        }
echo $this->getVar('content') ?>
	</main>
</div>
