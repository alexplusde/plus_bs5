<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addTextareaField('contact', null, ['class' => 'form-control '. rex_config::get('plus_bs5', 'editor')]);
$field->setLabel(rex_i18n::msg('plus_bs5_contact'));

$field = $form->addTextareaField('imprint', null, ['class' => 'form-control '. rex_config::get('plus_bs5', 'editor')]);
$field->setLabel(rex_i18n::msg('plus_bs5_imprint'));

$field = $form->addTextareaField('map', null, ['class' => 'form-control codemirror code-mirror']);
$field->setLabel(rex_i18n::msg('plus_bs5_map'));

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $this->i18n('plus_bs5_settings'), false);
$fragment->setVar('body', $form->get(), false);

?>
<div class="row">
    <div class="col-lg-8">
        <?= $fragment->parse('core/page/section.php') ?>
    </div>

    <div class="col-lg-4">
        <?php

$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=plus_bs5"><img src="'.rex_url::addonAssets('plus_bs5', 'jetzt-beauftragen.svg').'" style="width: 100% max-width: 400px;"></a>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('plus_bs5_donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5_info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
    </div>
</div>
