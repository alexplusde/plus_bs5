<?php

/**
 * @var rex_yform_value_abstract $this
 * @psalm-scope-this rex_yform_value_abstract
 * @var rex_yform_choice_list $choiceList
 * @var rex_yform_choice_list_view $choiceListView
 */

$notices = [];
if ($this->getElement('notice')) {
    $notices[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notices[] = '<span class="text-warning">'.rex_i18n::translate($this->params['warning_messages'][$this->getId()], false).'</span>';
}

if (!isset($groupAttributes)) {
    $groupAttributes = [];
}

$groupClass = ($choiceList->isMultiple() ? 'form-check-group' : 'form-radio-group').' my-1';
if (isset($groupAttributes['class']) && is_array($groupAttributes['class'])) {
    $groupAttributes['class'][] = $groupClass;
} elseif (isset($groupAttributes['class'])) {
    $groupAttributes['class'] .= ' '.$groupClass;
} else {
    $groupAttributes['class'] = $groupClass;
}

if (!isset($elementAttributes)) {
    $elementAttributes = [];
}
$elementClass = trim( 'form-check form-check-inline '.$this->getWarningClass());
if (isset($elementAttributes['class']) && is_array($elementAttributes['class'])) {
    $elementAttributes['class'][] = $elementClass;
} elseif (isset($elementAttributes['class'])) {
    $elementAttributes['class'] .= ' '.$elementClass;
} else {
    $elementAttributes['class'] = $elementClass;
}
?>

<?php $choiceOutput = function (rex_yform_choice_view $view) use ($elementAttributes, $choiceList) {
    ?>
    <div<?= rex_string::buildAttributes($elementAttributes) ?>>
        <input class="btn-check"
                value="<?= rex_escape($view->getValue()) ?>"
            <?= (in_array($view->getValue(), $this->getValue(), true) ? ' checked="checked"' : '') ?>
            <?= $view->getAttributesAsString() ?>
        />
        <label class="btn btn-primary"  for="<?= $view->getAttributes()['id'] ?>">
            <?= $view->getLabel() ?>
        </label>
    </div>
<?php
} ?>

<?php $choiceGroupOutput = static function (rex_yform_choice_group_view $view) use ($choiceOutput) {
        ?>
    <div class="form-check-group my-1">
        <label><?= rex_escape($view->getLabel()) ?></label>
        <?php foreach ($view->getChoices() as $choiceView): ?>
            <?php $choiceOutput($choiceView) ?>
        <?php endforeach ?>
    </div>
<?php
    } ?>

<?php
    if (!isset($groupAttributes['id'])) {
        $groupAttributes['id'] = $this->getHTMLId();
    }
 ?>
<div<?= rex_string::buildAttributes($groupAttributes) ?>>
    <?php if ($this->getLabel()): ?>
        <label class="form-label d-block">
            <?= rex_escape($this->getLabelStyle($this->getLabel())) ?>
        </label>
    <?php endif ?>

    <?php foreach ($choiceListView->getPreferredChoices() as $view): ?>
        <?php $view instanceof rex_yform_choice_group_view ? $choiceGroupOutput($view) : $choiceOutput($view) ?>
    <?php endforeach ?>

    <?php foreach ($choiceListView->getChoices() as $view): ?>
        <?php $view instanceof rex_yform_choice_group_view ? $choiceGroupOutput($view) : $choiceOutput($view) ?>
    <?php endforeach ?>

    <?php if ($notices): ?>
        <p class="help-block form-text small"><?= implode('<br />', $notices) ?></p>
    <?php endif ?>
</div>
