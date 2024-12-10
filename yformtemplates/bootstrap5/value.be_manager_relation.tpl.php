<?php

/**
 * @var rex_yform_value_be_manager_relation $this
 * @psalm-scope-this rex_yform_value_be_manager_relation
 */

$options ??= [];
$link ??= '';
$valueName ??= '';

$class_group = trim('form-group ' . $this->getHTMLClass() . ' ' . $this->getWarningClass());

$id = sprintf('%u', crc32($this->params['form_name'] . random_int(0, 100) . $this->getId()));

$notice = [];
if ('' != $this->getElement('notice')) {
    $notice[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notice[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()], false) . '</span>'; //    var_dump();
}
if (count($notice) > 0) {
    $notice = '<p class="help-block small">' . implode('<br />', $notice) . '</p>';
} else {
    $notice = '';
}

?>
<?php if ($this->relation['relation_type'] < 2 || 3 == $this->relation['relation_type']): ?>
    <div data-be-relation-wrapper="<?= $this->getFieldName() ?>" class="<?= $class_group ?>"
         id="<?= $this->getHTMLId() ?>">
        <label class="form-label"
               for="<?= $this->getFieldId() ?>"><?= $this->getLabelStyle($this->relation['label']) ?></label>
        <?php

        $attributes = [];
    $attributes['class'] = 'form-control mb-3';
    $attributes['id'] = $this->getFieldId();

    $select = new rex_select();

    if (1 == $this->relation['relation_type'] || 3 == $this->relation['relation_type']) {
        $select->setName($this->getFieldName() . '[]');
        $select->setMultiple();
        $select->setSize($this->relation['size']);
    } else {
        $select->setName($this->getFieldName());
    }

$attributes = $this->getAttributeArray($attributes, ['required', 'readonly', 'disabled']);

$select->setAttributes($attributes);
foreach ($options as $option) {
    $select->addOption($option['name'], $option['id']);
}

$select->setSelected($this->getValue());
echo $select->get();
?>
        <?= $notice ?>
    </div>
<?php else: ?>
    <div data-be-relation-wrapper="<?= $this->getFieldName() ?>" class="<?= $class_group ?>"
         id="<?= $this->getHTMLId() ?>">
        <label class="control-label"
               for="<?= $this->getFieldId() ?>"><?= $this->getLabelStyle($this->relation['label']) ?></label>
        <?php
$e = [];
    if (4 == $this->relation['relation_type']) {
        $e['field'] = '<input type="hidden" name="' . $this->getFieldName() . '" id="YFORM_DATASET_' . $id . '" value="' . implode(',', $this->getValue()) . '" />';
        if ($this->params['main_id'] > 0) {
            $e['functionButtons'] = '<a class="btn btn-popup" href="javascript:void(0);" onclick="newPoolWindow(\'' . $link . '\');return false;">' . rex_i18n::msg('yform_relation_edit_relations') . '</a>';
        } else {
            $e['after'] = '<p class="help-block small">' . rex_i18n::msg('yform_relation_first_create_data') . '</p>';
        }

        $fragment = new rex_fragment();
        $fragment->setVar('elements', [$e], false);
        echo $fragment->parse('core/form/widget.php');
    } elseif (2 == $this->relation['relation_type']) {
        $e['field'] = '<input class="form-control" type="text" name="YFORM_DATASET_NAME[' . $id . ']" value="' . htmlspecialchars($valueName) . '" id="YFORM_DATASET_SELECT_' . $id . '" readonly="readonly" /><input type="hidden" name="' . $this->getFieldName() . '" id="YFORM_DATASET_FIELD_' . $id . '" value="' . implode(',', $this->getValue()) . '" />';
        $e['functionButtons'] = '
                <a href="javascript:void(0);" class="btn btn-popup" onclick="openYFormDataset(' . $id . ', \'' . $this->relation['source_table'] . '.' . $this->getName() . '\', \'' . $link . '\',\'0\');return false;" title="' . rex_i18n::msg('yform_relation_choose_entry') . '"><i class="rex-icon rex-icon-add"></i></a>
                <a href="javascript:void(0);" class="btn btn-popup" onclick="deleteYFormDataset(' . $id . ',\'0\');return false;" title="' . rex_i18n::msg('yform_relation_delete_entry') . '"><i class="rex-icon rex-icon-remove"></i></a>';

        $fragment = new rex_fragment();
        $fragment->setVar('elements', [$e], false);
        echo $fragment->parse('core/form/widget.php');
    } else {
        $attributes = [];
        $attributes['class'] = 'form-control';
        $attributes = $this->getAttributeArray($attributes, ['required', 'readonly']);

        $select = new rex_select();
        $select->setAttributes($attributes);
        $select->setId('YFORM_DATASETLIST_SELECT_' . $id . '');
        $select->setName('YFORM_DATASETLIST_SELECT_' . $id . '');
        $select->setSize($this->relation['size']);
        foreach ($options as $option) {
            $select->addOption($option['name'], $option['id']);
        }
        $select->setSelected(implode(',', $this->getValue()));
        $e['field'] = $select->get() . '<input type="hidden" name="' . $this->getFieldName() . '" id="YFORM_DATASETLIST_FIELD_' . $id . '" value="' . implode(',', $this->getValue()) . '" />';

        $e['moveButtons'] = '
                <a href="javascript:void(0);" class="btn btn-popup" onclick="moveYFormDatasetList(' . $id . ',\'top\');return false;" title="' . rex_i18n::msg('yform_relation_move_first_data') . '"><i class="rex-icon rex-icon-top"></i></a>
                <a href="javascript:void(0);" class="btn btn-popup" onclick="moveYFormDatasetList(' . $id . ',\'up\');return false;" title="' . rex_i18n::msg('yform_relation_move_up_data') . '>"><i class="rex-icon rex-icon-up"></i></a>
                <a href="javascript:void(0);" class="btn btn-popup" onclick="moveYFormDatasetList(' . $id . ',\'down\');return false;" title="' . rex_i18n::msg('yform_relation_down_first_data') . '"><i class="rex-icon rex-icon-down"></i></a>
                <a href="javascript:void(0);" class="btn btn-popup" onclick="moveYFormDatasetList(' . $id . ',\'bottom\');return false;" title="' . rex_i18n::msg('yform_relation_move_last_data') . '"><i class="rex-icon rex-icon-bottom"></i></a>';
        $e['functionButtons'] = '
                <a href="javascript:void(0);" class="btn btn-popup" onclick="openYFormDatasetList(' . $id . ', \'' . $this->relation['source_table'] . '.' . $this->getName() . '\', \'' . $link . '\',\'1\');return false;" title="' . rex_i18n::msg('yform_relation_choose_entry') . '"><i class="rex-icon rex-icon-add"></i></a>
                <a href="javascript:void(0);" class="btn btn-popup" onclick="deleteYFormDatasetList(' . $id . ')return false;" title="' . rex_i18n::msg('yform_relation_delete_entry') . '"><i class="rex-icon rex-icon-remove"></i></a>
            ';

        $fragment = new rex_fragment();
        $fragment->setVar('elements', [$e], false);
        echo $fragment->parse('core/form/widget_list.php');
    }
    ?>
        <?= $notice ?>
    </div>
<?php endif;
