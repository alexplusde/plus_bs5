<?php

/**
 * @var rex_yform_value_checkbox $this
 * @psalm-scope-this rex_yform_value_checkbox
 */

$value = $value ?? $this->getValue() ?? '';

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

$class_group = trim('form-check ' . $this->getHTMLClass() . ' ' . $this->getWarningClass());

$attributes = [
    'type' => 'checkbox',
    'id' => $this->getFieldId(),
    'name' => $this->getFieldName(),
    'value' => 1,
];
if (1 == $value) {
    $attributes['checked'] = 'checked';
}

$attributes = $this->getAttributeElements($attributes, ['required', 'disabled', 'autofocus']);

?>
<div class="mb-3">
    <div class="<?= $class_group ?>">
        <input class="form-check-input"
               id="<?php echo $this->getHTMLId() ?>" <?= implode(' ', $attributes) ?>>
        <label class="form-check-label"
               for="<?php echo $this->getHTMLId() ?>">
            <?php echo $this->getLabel() ?>
        </label>
        <?php echo $notice; ?>
    </div>
</div>