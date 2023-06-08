<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);


$field = $form->addSelectField('vendor');
$field->setLabel($this->i18n('bs5_config_vendor_label'));
$field->setNotice($this->i18n('bs5_config_vendor_notice'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_vendor_disabled'), 'disabled');
$select->addOption($this->i18n('bs5_config_endor_local'), 'local');
$select->addOption($this->i18n('bs5_config_vendor_cdn'), 'cdn');


$field = $form->addInputField('text', 'text_more', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_more'));

$field = $form->addInputField('text', 'text_a18y_content', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_text_a18y_content'));


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

$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=plus_bs5"><img src="'.rex_url::addonAssets('plus_bs5', 'jetzt-spenden.svg').'" style="width: 100% max-width: 400px;"></a>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('bs5_donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('bs5_info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
	</div>
</div>
