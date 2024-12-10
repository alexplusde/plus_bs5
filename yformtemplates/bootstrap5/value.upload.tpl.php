<?php

/**
 * @var rex_yform_value_upload $this
 * @psalm-scope-this rex_yform_value_upload
 */

$unique ??= '';
$filename ??= '';
$download_link ??= '';
$error_messages ??= [];

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

$class_group = trim('form-group my-1 ' . $class . $this->getWarningClass());
$class_control = trim('form-control');

?>
<div class="<?= $class_group ?>" id="<?= $this->getHTMLId() ?>">
    <label class="form-label" for="<?= $this->getFieldId() ?>"><?= $this->getLabel() ?></label>
    <div class="input-group">
        <input class="<?= $class_control ?>" id="<?= $this->getFieldId() ?>" type="file" accept="<?= $this->getElement('types') ?>" name="<?= $unique ?>" />
        <span class="input-group-btn"><button class="btn btn-default" type="button" onclick="const file = document.getElementById('<?= $this->getFieldId() ?>'); file.value = '';">&times;</button></span>
    </div>
    <?= $notice ?>
    <input type="hidden" name="<?= $this->getFieldName('unique') ?>" value="<?= rex_escape($unique, 'html') ?>" />
</div>

<?php
    if ('' != $filename) {
        $label = htmlspecialchars($filename);

        if (rex::isBackend() && '' != $download_link) {
            $label = '<a href="' . $download_link . '">' . $label . '</a>';
        }

        echo '
            <div class="checkbox" id="' . $this->getHTMLId('checkbox') . '">
                <label>
                    <input type="checkbox" id="' .  $this->getFieldId('delete') . '" name="' . $this->getFieldName('delete') . '" value="1" />
                    ' . $error_messages['delete_file'] . ' "' . $label . '"
                </label>
            </div>';
    }
?>
