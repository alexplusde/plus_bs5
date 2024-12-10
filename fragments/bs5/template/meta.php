<?php

use FriendsOfRedaxo\YrewriteMetainfo\Domain;

/** @var rex_fragment $this */

echo Domain::getHead();

if (rex::isFrontend() && null === Domain::getCurrent()) {
    echo '</head><body>';
    dd('Bitte lege zunächst die Domain in den Domain-Metainfos von YRewrite an. (Addon: yrewrite_meta_infos)');
}

if ('cdn' == rex_config::get('plus_bs5', 'vendor')) {
    ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"
	crossorigin="anonymous">
<?php
} elseif ('local' == rex_config::get('plus_bs5', 'vendor')) {    ?>
<link href="/assets/addons/plus_bs5/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="/assets/addons/plus_bs5/js/bootstrap.bundle.min.js"
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="/assets/addons/plus_bs5/font/bootstrap-icons.css" crossorigin="anonymous">
<?php } ?>
