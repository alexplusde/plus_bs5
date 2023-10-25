<?php

$category_ids = $this->getVar('category_ids');
$question_ids = $this->getVar('question_ids');
$slice_id = $this->getVar('slice_id');

if (is_array($question_ids)) {
    $title = 'Einzelne Fragen';
    $questions = qanda::findByIds($question_ids);
} elseif (is_array($category_ids)) {
    $title = 'Einzelne Kategorien';
    $questions = qanda::findByCategoryIds($category_ids);
} else {
    $title = 'Standard';
    $questions = qanda::query()->where('status', 0, '>')->find();
}

?>
<div class="panel-group" id="accordion">

	<?php

$i = 0;
foreach ($questions as $question) {
    ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<a class="panel-title" data-toggle="collapse" data-parent="#accordion"
				href="#collapse<?= $slice_id . '_' . $i ?>">
				<?= $question->getQuestion() ?></a>
		</div>
		<div id="collapse<?= $slice_id . '_' . $i++ ?>"
			class="panel-collapse collapse out">
			<div class="panel-body">
				<?= $question->getAnswer() ?>
			</div>
		</div>
	</div>
	<?php
}
?>

</div>
