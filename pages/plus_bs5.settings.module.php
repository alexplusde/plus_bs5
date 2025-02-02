<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addInputField('text', 'text_more', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_more'));

$field = $form->addInputField('text', 'text_a18y_content', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_a18y_content'));

$field = $form->addInputField('text', 'text_slideshow_prev', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_slideshow_prev'));

$field = $form->addInputField('text', 'text_slideshow_next', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_slideshow_next'));

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', $this->i18n('bs5_config_settings'), false);
$fragment->setVar('body', $form->get(), false);

?>
<div class="row">
	<div class="col-lg-8">
		<?= $fragment->parse('core/page/section.php') ?>
	</div>

	<div class="col-lg-4">
		<?php

$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=plus_bs5"><img src="' . rex_url::addonAssets('plus_bs5', 'jetzt-beauftragen.svg') . '" style="width: 100% max-width: 400px;"></a>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('plus_bs5.settings.donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('bs5_info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
	</div>
</div>
