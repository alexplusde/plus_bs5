<?php

namespace Alexplusde\BS5;

use  \FriendsOfRedaxo\Mform as OriginalMForm;

class MForm extends OriginalMForm
{
    public static function defaultFactory() {

        $mform = new parent();
        
        $mform->addFieldsetArea('');

        // Row und Cols
        $mform->addHtml('<div class="row">');
        $mform->addHtml('<div class="col-md-3">');
        
        // Select-Feld h1,h2,h3,h4 und p
        $mform->addSelectField(2, ['h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'p' => 'p'], ['label' => \rex_i18n::msg('bs5.module.mform.headline_level')]);

        $mform->addHtml('</div>');
        $mform->addHtml('<div class="col-md-9">');

        // Textfeld
        $mform->addTextField(1, ['label' => \rex_i18n::msg('bs5.module.mform.headline')]);

        $mform->addHtml('</div>');
        $mform->addHtml('</div>');

        // Redaactor-Textarea
        $mform->addTextAreaField(3, ['label' => \rex_i18n::msg('bs5.module.mform.text'), 'class' => 'form-control redactor-editor--text']);

        // CTA-Textfeld
        $mform->addTextField(4, ['label' => \rex_i18n::msg('bs5.module.mform.cta_text'), 'class' => 'form-control redactor-editor--mini']);

        // Bild-Auswahlfeld
        // $mform->addMediaField(1, ['label' => \rex_i18n::msg('bs5.module.mform.image')]);

        // Hintergrundbild-Auswahlfeld
        // $mform->addMediaField(2, ['label' => \rex_i18n::msg('bs5.module.mform.background_image')]);

        // Layout-Optionen
        // $mform->addSelectField(6, ['label' => \rex_i18n::msg('bs5.module.mform.layout'), 'options' => ['' => \rex_i18n::msg('bs5.module.mform.layout_default'), 'container' => \rex_i18n::msg('bs5.module.mform.layout_container'), 'container-fluid' => \rex_i18n::msg('bs5.module.mform.layout_container_fluid')]]);

        return $mform;

    }
}
