<?php

/**
 * @var rex_yform_value_checkbox $this
 * @psalm-scope-this rex_yform_value_checkbox
 */

$options = $options ?? [];

$notices = [];
if ('' != $this->getElement('notice')) {
    $notices[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notices[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()], false) . '</span>';
}

$notice = '';
if (count($notices) > 0) {
    $notice = '<p class="help-block form-text small">' . implode('<br />', $notices) . '</p>';
}

?>

<?php if ('' != trim($this->getLabel())): ?>
<div class="form-check-group form-group my-1">
    <label class="form-label"><?php echo $this->getLabel() ?></label>

<?php endif; ?>

<?php foreach ($options as $k => $v): ?>
    <?php
    $class_group = trim('checkbox ' . $this->getHTMLClass() . ' ' . $this->getWarningClass());
    ?>

        <div class="<?= $class_group ?> my-1">
            <input class="form-check-input" type="checkbox" name="<?= $this->getFieldName() ?>[]" value="<?= $k ?>"<?= in_array($k, $this->getValue()) ? ' checked="checked"' : '' ?> />
            <label class="form-check-label" for="disabledFieldsetCheck">
                <?= $this->getLabelStyle($v) ?>
            </label>
            <?php echo $notice; ?>
        </div>

<?php endforeach ?>
<?php echo $notice; ?>

<?php if ('' != trim($this->getLabel())): ?>
</div>
<?php endif; ?>
