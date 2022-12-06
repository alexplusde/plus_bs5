<?php if ($this->getVar('level') ?? "h1") {
    echo '<'. $this->getVar('level') . '>';
} ?>

<?= $this->getVar('headline'); ?>

<?php if ($this->getVar('level') ?? "h1") {
    echo '<'. $this->getVar('level') . '>';
}
?>