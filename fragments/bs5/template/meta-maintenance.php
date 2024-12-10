<?php
namespace Alexplusde\BS5;

use FriendsOfRedaxo\YrewriteMetainfo\Domain;
use rex_config;


/** @var \rex_fragment $this */
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?= Domain::getHead() ?>

<?php if ('cdn' == rex_config::get('plus_bs5', 'vendor')) {
    ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
	integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
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
<?php } else {
    ?>
<link rel="stylesheet"
	href="<?= Template::getAssetUrl('styles/styles.min.css') ?>">
<script type="text/javascript"
	src="<?= Template::getAssetUrl('scripts/bootstrap.bundle.min.js') ?>"
	async></script>
<script type="text/javascript"
	src="<?= Template::getAssetUrl('scripts/project.js') ?>"
	async></script>

<?php
}
?>
