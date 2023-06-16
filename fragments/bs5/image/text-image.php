<?php

$image = $this->getVar('image');

?>
<div>
	<?php

     if ($media = rex_media_plus::get($image)) {
         ?>
	<?= media_manager_type_group::getPicture('default', $media) ?>
	<?php
     } // if $media
?>

</div>
