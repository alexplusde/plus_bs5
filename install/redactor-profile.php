<?php

if(Redactor::profileExists('default') === false) {
    Redactor::insertProfile('default', 'plus_bs5: Standard', 300, 800, null, null, 'html,|,undo,redo,|,h1,h2,h3,h4,bold,italic,|,blockquote,lists[indent],ol,ul,linkExternal,linkInternal,hr,table,widget');
}

if(Redactor::profileExists('text') === false) {
    Redactor::insertProfile('text', 'plus_bs5: Text', 300, 600, null, null, 'undo,redo,|,h1,h2,h3,h4,bold,italic,|,image,blockquote,lists[indent],ol,ul,linkExternal,linkInternal,hr,table,widget');
}

if(Redactor::profileExists('mini') === false) {
    Redactor::insertProfile('mini', 'plus_bs5: Mini', 150, 300, null, null, 'undo,redo,|,bold,italic,|,linkExternal,linkInternal,hr,table,widget');
}

/** @var rex_addon $redactor */
$redactor = rex_addon::get('redactor');
$redactor->clearCache();
