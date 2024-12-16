<?php

/** @var Fragment $this */

namespace FriendsOfRedaxo\Neues;

use rex_media_plus;

$images = $this->getVar('images', []);

$mediaItems = [];
foreach ($images as $image) {
    $media = rex_media_plus::get($image);
    if ($media !== null) {
        $mediaItems[] = $media;
    }
}
$mediaItems = \array_filter($mediaItems);
if (empty($mediaItems)) {
    return;
}
?>
<!-- BEGIN plus_bs5/fragments/neues/entry-gallery.php -->
<h2 class="h4">Weitere Bilder</h2>
<div class="row cols-2 g-2 g-md-3 g-lg-4">
	<?php
foreach ($mediaItems as $media) {
    $this->setVar('media', $media);
    echo $this->subFragment('bs5/neues/entry-gallery-item.php');
}

?>
</div>
<!-- END plus_bs5/fragments/neues/entry-gallery.php -->
