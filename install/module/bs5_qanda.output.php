<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

/** @var rex_article_content $this */

if (!rex_addon::get('qanda') && !rex_addon::get('qanda')->isAvailable()) {
    echo rex_view::error(rex_i18n::msg('bs5-install-qanda'));
    return;
};

$headline = "REX_VALUE[1]";
$category_ids = rex_var::toArray("REX_VALUE[2]");

$qanda_category = qanda_category::query()->whereListContains('id', $category_ids)->find();
?>
<section>
  <div class="row g-3">
    <div class="col-12">
      <h2 class="my-5"><?= $headline ?><?= \Alexplusde\BS5\Helper::getBackendEditLink(); ?></h2>
      </div>
    <div class="col-12">
      <?php
      foreach ($qanda_category as $category) {
          /** @var qanda_category $category */
          ?>

        <h3><?= $category->getName() ?></h3>
      <?php
            foreach ($category->getAllQuestions() as $question) {
                /** @var qanda $question */
                ?>
          <details class="card mb-3 p-3">
            <summary class="card-title h5">
              <?= $question->getQuestion() ?>
              <?= \Alexplusde\BS5\Helper::getBackendTableManagerEditLink($question->getTableName(), $question->getId(), 'qanda/qanda'); ?>
            </summary>
            <div class="card-body">
              <?= $question->getAnswer() ?>

            </div>
          </details>
      <?php
                    echo $question->showJsonLd($question);
            }
      }
?>
    </div>
  </div>
</section>
