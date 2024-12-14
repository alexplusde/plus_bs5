<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addSelectField('dev');
$field->setLabel($this->i18n('bs5_config_dev_label'));
$field->setNotice($this->i18n('bs5_config_dev_notice'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_dev_active'), '1');
$select->addOption($this->i18n('bs5_config_dev_inactive'), '0');

$fragment = new rex_fragment();
$fragment->setVar('class', 'danger', false);
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
$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5.settings.info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
	</div>
</div>
