<div class="container">

	<?php
foreach (qanda::getAll() as $question) {
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
