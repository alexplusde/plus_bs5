<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use rex_media_plus;

/** @var rex_media_plus $media */
$media = $this->getVar('media');

?>
<!-- BEGIN plus_bs5/fragments/neues/entry-gallery-item.php -->
<div class="col mb-3">
	<?= $media->setClass('img-fluid')->getImg('bs5-thumbnail'); ?>
</div>
<!-- END plus_bs5/fragments/neues/entry-gallery-item.php -->
