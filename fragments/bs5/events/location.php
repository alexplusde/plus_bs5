<?php

namespace Alexplusde\Events;

/** @var rex_fragment|Fragment $this */


$location = $this->getVar('location');
if (!$location) {
    return;
}

?>
<!-- BEGIN plus_bs5/fragments/bs5/events/location.php -->
<div class="card my-2">
	<div class="card-header">
		{{ events.location.title}}
	</div>
	<div class="card-body">
		<address>
			<?= $location->getName() ?><br>
			<?= $location->getStreet() ?><br>
			<?= $location->getZip() ?>
			<?= $location->getCity() ?><br>
		</address>
	</div>
</div>
<!-- END plus_bs5/fragments/bs5/events/location.php -->
