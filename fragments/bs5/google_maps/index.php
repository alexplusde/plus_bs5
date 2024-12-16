<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


$slice_id = $this->getVar('slice_id');
$article_id = $this->getVar('article_id');

$data_id = $this->getVar('data_id');
?>
<!-- BEGIN plus_bs5/fragments/bs5/google_maps/index.php -->
<?= Helper::getBackendEditLink($article_id, null, $slice_id) ?>
<div class="maps"
    data-service="google_maps"
    data-id="<?= $data_id ?>"
    data-autoscale>
</div>
<!-- END plus_bs5/fragments/bs5/google_maps/index.php -->
