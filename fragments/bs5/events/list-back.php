<?php

namespace Alexplusde\Events;

/** @var rex_fragment|Fragment $this */


use rex_config;

?>
<!-- BEGIN plus_bs5/fragments/bs5/events/list-back.php -->
<a class="btn btn-secondary" href="<?= rex_getUrl(rex_config::get('events', 'article_id')) ?>">
    <i class="bi bi-arrow-left"></i> {{events.list.back}}
</a>
<!-- END plus_bs5/fragments/bs5/events/list-back.php -->
