<?php
/** @var rex_fragment|Fragment $this */


switch ($this->getVar('type')) {
    default:
    case 'default':
        $this->setVar('labelColClass', 'col-md-12');
        $this->setVar('formItemColClass', 'col-md-12');
        break;
    case 'default_full':
    case 'default_custom_full':
        $this->setVar('labelColClass', 'col-sm-12');
        $this->setVar('formItemColClass', 'col-sm-12');
        break;
}

$labelWrapperOpen = '<div class="' . $this->getVar('labelColClass') . '">';
$labelWrapperClose = '</div>';
$inputWrapperOpen = '<div class="' . $this->getVar('formItemColClass') . '">';
$inputWrapperClose = ($this->getVar('notCloseInputWrapper')) ? '' : '</div>';
$formGroupClose = ($this->getVar('notClosedFormGroup')) ? '' : '</div>';

echo '<div class="form-group ' . $this->getVar('class') . '">' . $labelWrapperOpen . $this->getVar('label') . $this->getVar('infoTooltip') . $this->getVar('infoCollapseButton') . $labelWrapperClose . $inputWrapperOpen . $this->getVar('element') . $inputWrapperClose . $formGroupClose . $this->getVar('infoCollapse');
