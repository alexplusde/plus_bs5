<?php

$image = $this->getVar('image');

?>
<div
	class="container p-0 <?= rex_config::get('plus_bs5', 'container_class') ?>">
	<?php

     if ($media = rex_media_plus::get($image)) {
         ?>
	<?= media_manager_type_group::getPicture('default', $media, 'w-100 img-fluid') ?>

	<?php
     } // if $media
?>

</div>
