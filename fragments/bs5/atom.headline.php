<?php if ($this->getVar('level') ?? 'h2') {
    echo '<'. $this->getVar('level') . '>';
} ?>

<?= $this->getVar('headline') ?>

<?php if ($this->getVar('level') ?? 'h2') {
    echo '</'. $this->getVar('level') . '>';
}
?>