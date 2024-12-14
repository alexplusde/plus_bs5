<?php

namespace Alexplusde\BS5;

use Alexplusde\BS5\Helper;

/** @var rex_fragment|Fragment $this */
/** @var rex_media|rex_media_plus $media */
$media = $this->getVar('media');
if(!$media) {
    $image = $this->getVar('image');
    $profile = $this->getVar('image_profile') ?? "default";
    $class = $this->getVar('image_class') ?? "img-fluid";
    $tag = $this->getVar('image_tag') ?? "img";
    $media = \rex_media_plus::get($image);
}

if(!$media) {
    return;
}
$media->setClass($class);
?>
<!-- BEGIN plus_bs5/fragments/bs5/atom/image.php -->
<?php
if($tag == "img") {
    echo $media->getImg($profile);
} 
if($tag == "picture") {
    echo $media->getPicture($profile);
}
if($tag == "base64") {
    echo $media->getImgBase64($profile);
}
if($tag == "svg") {
    echo $media->getSvg($profile);
}
?>
<!-- END plus_bs5/fragments/bs5/atom/image.php -->
