<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addTextareaField('header', null, ['class' => 'form-control ' . rex_config::get('plus_bs5', 'editor')]);
$field->setLabel(rex_i18n::msg('bs5_config_header'));

$field = $form->addSelectField('nav_depth');
$field->setLabel($this->i18n('bs5_config_nav_depth_label'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_nav_depth_1'), '1');
$select->addOption($this->i18n('bs5_config_nav_depth_2'), '2');

$field = $form->addSelectField('mobile_nav_layout');
$field->setLabel($this->i18n('bs5.config.mobile_nav_layout.label'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5.config.mobile_nav_layout.option.offcanvas'), 'offcanvas');
$select->addOption($this->i18n('bs5.config.mobile_nav_layout.option.modal'), 'modal');
$field->setNotice($this->i18n('bs5.config.mobile_nav_layout.notice'));

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
$fragment->setVar('title', $this->i18n('plus_plus_bs5.settings.donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5_info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
	</div>
</div>
