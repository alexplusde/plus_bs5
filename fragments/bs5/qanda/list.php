<?php


$category_ids = $this->getVar("category_ids");
$question_ids = $this->getVar("question_ids");

if(is_array($question_ids)) {
    $title = "Einzelne Fragen";
    $questions = qanda::findByIds($question_ids);
} elseif(is_array($category_ids)) {
    $title = "Einzelne Kategorien";
    $questions = qanda::findByCategoryIds($category_ids);
} else {
    $title = "Standard";
    $questions = qanda::query()->where('status', 0, ">")->find();
}

?>
<div class="container">

	<?php
foreach ($questions as $question) {
    ?>

	<details class="card">
		<summary class="card-body card-title h4">
			<?= $question->getQuestion() ?>
		</summary>
		<div class="card-body">
			<?= $question->getAnswer() ?>
		</div>
	</details>
	<?php
    echo $question->showJsonLd($question);
}
?>

</div>
