<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addSelectField('background');
$field->setLabel($this->i18n('bs5_config_background_label'));
$field->setNotice($this->i18n('bs5_config_background_notice'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_background_white'), 'bg-white');
$select->addOption($this->i18n('bs5_config_background_primary'), 'bg-primary');
$select->addOption($this->i18n('bs5_config_background_light'), 'bg-light');
$select->addOption($this->i18n('bs5_config_background_dark'), 'bg-dark');
$select->addOption($this->i18n('bs5_config_background_transparent'), 'bg-transparent');

$field = $form->addInputField('text', 'container_class', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_container_class'));
$field->setNotice('z.B. <code>shadow</code>');

$field = $form->addInputField('text', 'border', null, ['class' => 'form-control']);
$field->setLabel(rex_i18n::msg('bs5_config_border_label'));
$field->setNotice('bs5_config_border_notice');

$field = $form->addLinkmapField('search_article_id');
$field->setLabel($this->i18n('bs5_config_search_article_id'));
$field->setNotice($this->i18n('bs5_config_search_article_id_notice'));

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
$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5.settings.info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
	</div>
</div>
