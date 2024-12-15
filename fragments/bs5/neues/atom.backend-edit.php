<?php

namespace FriendsOfRedaxo\Neues;

use Alexplusde\BS5\Helper;

/** @var rex_fragment|Fragment $this */

$entry = $this->getVar('entry');
/** @var Entry $entry */

echo Helper::getBackendTableManagerEditLink('rex_neues_entry', $entry->getId(), 'neues/entry');

?>
