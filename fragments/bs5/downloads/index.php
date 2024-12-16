<?php

/** @var Fragment $this */

use Alexplusde\BS5\Helper;

$filename = $this->getVar('file');
$media = rex_media::get($filename);

if (!is_object($media)) {
    return;
}

$is_image = $media->isImage();
$is_pdf = $media->getExtension() == 'pdf';
?>
<div class="card h-100">
	<div class="row">
		<div class="col-md-3">
			<?php if ($is_image): ?>
				<div class="image-wrapper">
					<img class="img-fluid" src="/media/download-thumbnail/<?= $media->getFileName() ?>" alt="<?= $this->title ?>">
				</div>
			<?php elseif ($is_pdf): ?>
				<div class="image-wrapper">
					<img class="img-fluid" src="/media/download-thumbnail/<?= $media->getFileName() ?>" alt="<?= $this->title ?>">
				</div>
			<?php else: ?>
				<div class="extension-wrapper position-relative bg-secondary text-white">
					<div class="file-extension position-absolute top-50 start-50 translate-middle"><?= $this->extension ?></div>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-md-9 p-3">
			<div class="h5">
				<?= $media->getTitle() ?>
		</div>
			<p class="text-muted"><?= $media->getValue('med_description') ?> <span class="file-filesize badge badge-small">(<?= $media->getFormattedSize() ?>)</span></p>
			<a class="file-download btn btn-primary" href="/download/<?= $this->file ?>" title="<?= $this->title ?>" data-extension="<?= $this->extension ?>" data-layout="<?= $this->layout ?>">Download</a>
			<?= Helper::getBackendMediapoolEditLink($media->getFileName()) ?>
		</div>
	</div>
</div>
