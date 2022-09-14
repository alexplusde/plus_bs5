<?php

/**
 * @var rex_yform_value_textarea $this
 * @psalm-scope-this rex_yform_value_textarea
 */

$notice = [];
if ('' != sprogdown($this->getElement('notice'))) {
    $notice[] = rex_i18n::translate(sprogdown($this->getElement('notice')), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notice[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()], false) . '</span>';
}
if (count($notice) > 0) {
    $notice = '<p class="help-block form-text small">' . implode('<br />', $notice) . '</p>';
} else {
    $notice = '';
}

$class_group = [];
$class_group['form-group'] = 'form-group mb-4';
if (!empty($this->getWarningClass())) {
    $class_group[$this->getWarningClass()] = $this->getWarningClass();
}

$class_label[] = 'form-label';

$rows = $this->getElement('rows');
if (!$rows) {
    $rows = 4;
}

$attributes = [
    'class' => 'form-control',
    'name' => $this->getFieldName(),
    'id' => $this->getFieldId(),
    'rows' => $rows,
];

$attributes = $this->getAttributeElements($attributes, ['placeholder', 'pattern', 'required', 'disabled', 'readonly']);

echo '<div class="' . implode(' ', $class_group) . '" id="' . $this->getHTMLId() . '">
        <label class="' . implode(' ', $class_label) . '" for="' . $this->getFieldId() . '">' . $this->getLabel() . '</label>' . $notice . '
        <textarea ' . implode(' ', $attributes) . '>' . rex_escape($this->getValue()) . '</textarea>' .
    '</div>';
