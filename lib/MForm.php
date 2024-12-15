<?php

namespace Alexplusde\BS5;

use  \FriendsOfRedaxo\Mform as OriginalMForm;

class MForm extends OriginalMForm
{
    public static function defaultFactory(...$value_ids) : OriginalMForm
    {

        // Standards: https://github.com/alexplusde/plus_bs5?tab=readme-ov-file#rex_values

        // Wenn keine $value_ids übergeben werden, dann alle ausgeben
        if (empty($value_ids)) {
            $value_ids = [1, 2, 4, 8];
        }

        $mform = new parent();

        $mform->addFieldsetArea('');

        if (in_array(1, $value_ids) || in_array(2, $value_ids)) {
            // Row und Cols
            $mform->addHtml('<div class="row">');
            $mform->addHtml('<div class="col-md-3">');

            // Select-Feld h1,h2,h3,h4 und p
            $mform->addSelectField(2, ['h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'p' => 'p'], ['label' => \rex_i18n::msg('bs5.module.mform.headline_level')], 1, "h2");
        

            $mform->addHtml('</div>');
            $mform->addHtml('<div class="col-md-9">');

            // Textfeld
            $mform->addTextField(1, ['label' => \rex_i18n::msg('bs5.module.mform.headline')]);

            $mform->addHtml('</div>');
            $mform->addHtml('</div>');
        }

        // Wenn 3 in $value_ids enthalten ist, dann Teaser-Eingabefeld ausgegeben
        if (in_array(3, $value_ids)) {
            // Textfeld
            $mform->addTextField(3, ['label' => \rex_i18n::msg('bs5.module.mform.teaser')]);
        }

        // Wenn 4 in $value_ids enthalten ist, dann Text-Textfeld ausgegeben
        if (in_array(4, $value_ids)) {
            // WYSIWYG-Textarea
            $mform->addTextAreaField(4, ['label' => \rex_i18n::msg('bs5.module.mform.text'), 'class' => 'form-control redactor-editor--text', 'id' => 'redactor-editor-' . rand(1, 999999)]);
        }

        if (in_array(8, $value_ids)) {
            // CTA-Textfeld
            $mform->addTextAreaField(8, ['label' => \rex_i18n::msg('bs5.module.mform.cta_text'), 'class' => 'form-control redactor-editor--mini', 'id' => 'redactor-editor-' . rand(1, 999999)]);
        }

        // Bild-Auswahlfeld
        $mform->addMediaField(1, ['label' => \rex_i18n::msg('bs5.module.mform.image')]);

        // Hintergrundbild-Auswahlfeld
        $mform->addMediaField(2, ['label' => \rex_i18n::msg('bs5.module.mform.background_image')]);

        // Layout-Optionen
        // $mform->addSelectField(6, ['label' => \rex_i18n::msg('bs5.module.mform.layout'), 'options' => ['' => \rex_i18n::msg('bs5.module.mform.layout_default'), 'container' => \rex_i18n::msg('bs5.module.mform.layout_container'), 'container-fluid' => \rex_i18n::msg('bs5.module.mform.layout_container_fluid')]]);

        return $mform;
    }
}
