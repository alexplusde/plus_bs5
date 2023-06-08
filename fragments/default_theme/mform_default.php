<?php

switch ($this->type) {
    case 'default':
        $this->labelColClass = 'col-sm-12';
        $this->formItemColClass = 'col-sm-12';
        break;
    case 'default_full':
    case 'default_custom_full':
        $this->labelColClass = 'col-sm-12';
        $this->formItemColClass = 'col-sm-12';
        break;
}

$labelWrapper = '<div class="' . $this->labelColClass . '">';
$labelWrapperEnd = '</div>';
$inputWrapper = '<div class="' . $this->formItemColClass . '">';
$inputWrapperEnd = '</div>';

if ($this->inline == true) {
    $labelWrapper = '';
    $labelWrapperEnd = '';
    $inputWrapper = '';
    $inputWrapperEnd = '';
}

echo '<div class="form-group ' . $this->class . '">' . $labelWrapper . $this->label . $this->infoTooltip . $this->infoCollapseButton . $labelWrapperEnd . $inputWrapper . $this->element . $inputWrapperEnd . '</div>' . $this->infoCollapse;
