<?php

/** @var rex_fragment $this */

namespace FriendsOfRedaxo\Neues;

use Url\Url;

$dataset = null;
$manager = Url::resolveCurrent();
if ($manager) {
    /** @var Category|Entry $dataset */
    $dataset = $manager->getDataset();
}
?>
<!-- BEGIN plus_bs5/fragments/neues/index.php -->
<?php
if ($dataset instanceof Category) {
    echo $this->subFragment('bs5/neues/list.php', ['category' => $dataset]);
}

if ($dataset instanceof Entry) {
    echo $this->subFragment('bs5/neues/entry-details.php', ['neues' => $dataset]);
}

if (null === $dataset) {
    echo $this->subFragment('bs5/neues/list.php');
}
?>
<!-- END plus_bs5/fragments/neues/index.php -->
