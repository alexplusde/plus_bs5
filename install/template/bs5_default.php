<?php
use Alexplusde\BS5\Fragment;

$clang = rex_clang::getCurrent();
setlocale(LC_ALL, $clang->getValue('locale'), $clang->getCode()); 

$fragment = new Fragment();
$fragment->setVar('TEMPLATE_KEY', "REX_TEMPLATE_KEY");
$fragment->setVar('CLANG', $clang);
$fragment->setVar('content1', "REX_ARTICLE[ctype=1]", false);
$fragment->setVar('content2', "REX_ARTICLE[ctype=2]", false);
$fragment->setVar('content', $fragment->getVar('content1') . $fragment->getVar('content2'), false);
?>
<!DOCTYPE html>
<html class="template-REX_TEMPLATE_KEY" lang="<?= $clang->getCode(); ?>">
    <head>
        <link href="<?= speed_up_asset::getUrl("addons/project/css/project.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?= speed_up_asset::getUrl("addons/plus_bs5/fonts/bootstrap-icons.css") ?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?= speed_up_asset::getUrl('addons/plyr/vendor/plyr/dist/plyr.css') ?>">
        <?= $fragment->parse('bs5/template/meta.php'); ?>
    </head>

    <body>
        <div class="screen-darken"></div>
        <?= $fragment->parse('bs5/template/header.php'); ?>
        <?= $fragment->parse('bs5/template/breadcrumb.php'); ?>
        <?= $fragment->parse('bs5/template/main.php'); ?>
        <?= $fragment->parse('bs5/template/footer.php'); ?>

        <script src="<?= speed_up_asset::getUrl('addons/project/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= speed_up_asset::getUrl('addons/plyr/vendor/plyr/dist/plyr.min.js') ?>"></script>
        <script src="<?= speed_up_asset::getUrl('addons/plyr/plyr_init.js') ?>"></script>
        <script src="<?= speed_up_asset::getUrl("addons/project/js/project.js") ?>"></script>
    </body>
</html>
