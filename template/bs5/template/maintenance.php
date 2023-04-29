<!DOCTYPE html>
<html class="template-REX_TEMPLATE_KEY"
    lang="<?php echo rex_clang::getCurrent()->getCode(); ?>">

<head>
    <?php
    $fragment = new bs5_fragment();
    $fragment->setVar('content', "REX_ARTICLE[]", false);
    echo $fragment->parse('bs5/template/head-maintenance.php');
    ?>
</head>

<body>
    <a class="visually-hidden-focusable" href="#content">Zum Inhalt
        springen</a>

    <div class="screen-darken"></div>
    <?php

    echo $fragment->parse('bs5/template/maintenance.php');
    ?>

</body>

</html>