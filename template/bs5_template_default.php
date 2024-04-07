<!DOCTYPE html>
<html class="template-REX_TEMPLATE_KEY"
	lang="<?= rex_clang::getCurrent()->getCode() ?>">

<head>
	<?php
    $fragment = new bs5_fragment();
	$fragment->setVar('content', 'REX_ARTICLE[]', false);
	echo $fragment->parse('bs5/template/meta.php');
	?>
</head>

<body class="<?= bs5::getConfig('background') ?>">
	<a class="visually-hidden-focusable" href="#content"><?= bs5::getConfigText('text_a18y_content') ?></a>
	<?php

	echo $fragment->parse('bs5/template/header.php');

	echo $fragment->parse('bs5/template/main.php');

	echo $fragment->parse('bs5/template/footer.php');
	?>

</body>

</html>
