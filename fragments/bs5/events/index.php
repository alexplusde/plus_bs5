<?php

/** @var Fragment $this */

namespace Alexplusde\Events;

use Url\Url;

$dataset = null;
$manager = Url::resolveCurrent();
if ($manager) {
    /** @var Category|Date $dataset */
    $dataset = $manager->getDataset();
}
?>
<!-- BEGIN plus_bs5/fragments/events/index.php -->
<?php
if ($dataset instanceof Category) {
    echo $this->subFragment('bs5/events/list.php', ['category' => $dataset]);
}

if ($dataset instanceof Date) {
    echo $this->subFragment('bs5/events/date-details.php', ['date' => $dataset]);
}

if (null === $dataset) {
    echo $this->subFragment('bs5/events/list.php');
}
?>
<!-- END plus_bs5/fragments/events/index.php -->
