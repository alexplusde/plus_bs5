<?php

$image = $this->getVar('image');

?>
<div>
	<?php

     if ($media = rex_media_plus::get($image)) {
         ?>
	<?= media_manager_type_group::getPicture('default', $media, 'w-100 img-fluid') ?>

	<?php
     } // if $media
?>

</div>
