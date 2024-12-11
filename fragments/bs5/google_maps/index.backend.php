<?php

namespace Alexplusde\School;

use rex_sql;
use Alexplusde\BS5\Helper;

/** @var rex_fragment $this */

$data_id = $this->getVar('data_id');
?>
<div class="embed-responsive embed-responsive-16by9">
    <iframe class="embed-responsive-item"
        src="https://www.google.com/maps/embed?pb=<?= $data_id; ?>"
        width="600"
        height="450"
        border="0">
    </iframe>
</div>
