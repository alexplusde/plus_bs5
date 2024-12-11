<?php

namespace Alexplusde\School;

use rex_sql;
use Alexplusde\BS5\Helper;

/** @var rex_fragment $this */

$data_id = $this->getVar('data_id');
?>
<div class="maps"
    data-service="google_maps"
    data-id="<?= $data_id ?>"
    data-autoscale>
</div>
