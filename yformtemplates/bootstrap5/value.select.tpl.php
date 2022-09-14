<?php

/**
 * @var rex_yform_value_abstract $this
 * @psalm-scope-this rex_yform_value_abstract
 */

$multiple = $multiple ?? false;
$size = $size ?? 1;
$options = $options ?? [];

$notice = [];
if ('' != $this->getElement('notice')) {
    $notice[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notice[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()], false) . '</span>'; //    var_dump();
}
if (count($notice) > 0) {
    $notice = '<p class="help-block form-text small">' . implode('<br />', $notice) . '</p>';
} else {
    $notice = '';
}

$class = $this->getElement('required') ? 'form-is-required ' : '';
$class_group = trim('form-group ' . $class . $this->getWarningClass());

$class_label[] = 'form-label';

$attributes = [];
$attributes['class'] = 'form-select';
$attributes['id'] = $this->getFieldId();
if ($multiple) {
    $attributes['name'] = $this->getFieldName() . '[]';
    $attributes['multiple'] = 'multiple';
} else {
    $attributes['name'] = $this->getFieldName();
}
if ($size > 1) {
    $attributes['size'] = $size;
}

$attributes = $this->getAttributeElements($attributes, ['autocomplete', 'pattern', 'required', 'disabled', 'readonly']);

echo '
<div class="' . $class_group . '" id="' . $this->getHTMLId() . '">
    <label class="' . implode(' ', $class_label) . '" for="' . $this->getFieldId() . '">' . $this->getLabel() . '</label>' . $notice . '
    <select ' . implode(' ', $attributes) . '>';
foreach ($options as $key => $value):
    echo '<option value="' . htmlspecialchars($key) . '" ';
    if (in_array((string)$key, $this->getValue(), true)) {
        echo ' selected="selected"';
    }
    echo '>';
    echo $this->getLabelStyle($value);
    echo '</option>';
endforeach;
echo '
    </select>
</div>';
