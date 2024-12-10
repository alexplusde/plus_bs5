<?php

/**
 * @var rex_yform_value_signature $this
 * @psalm-scope-this rex_yform_value_signature
 */

if(!isset($value)) {
    $value = $this->getValue();
}

$notice = [];

if ('' != $this->getElement('notice')) {
    $notice[] = rex_i18n::translate($this->getElement('notice'), false);
}
if (isset($this->params['warning_messages'][$this->getId()]) && !$this->params['hide_field_warning_messages']) {
    $notice[] = '<span class="text-warning">' . rex_i18n::translate($this->params['warning_messages'][$this->getId()]) . '</span>';
}
if (count($notice) > 0) {
    $notice = '<p class="help-block form-text small">' . implode('<br />', $notice) . '</p>';
} else {
    $notice = '';
}

$class_group = trim('form-group my-1 ' . $this->getWarningClass());
$class_label[] = 'form-label';

$field_before = '';
$field_after = '';
$specialAttributes = $this->getAttributeArray([]);

$attributes = [
    'class' => 'form-control signature',
    'name' => $this->getFieldName(),
    'type' => 'hidden',
    'id' => 'canvas-target-'. $this->getName(),
    'value' => $value,
];

$attributes = $this->getAttributeElements($attributes, ['placeholder', 'autocomplete', 'pattern', 'required', 'disabled', 'readonly']);

?>
<div class="<?= $class_group ?>" id="<?= $this->getHTMLId() ?>">
    <label class="<?= implode(' ', $class_label) ?>"><?= $this->getLabel() ?></label>
    <div style="position: relative; display: flex; flex-direction: row; align-items: center; align-content: flex-start;">
        <div class="canvas-wrapper form-control" style="position: relative; width: 300px; height: 80px; background-color: #FFF;">
            <canvas id="canvas-<?= $this->getName() ?>" style="width: 100%; height: 100%; background-color: transparent; position: relative; z-index: 1;"></canvas>
            <?php if(isset($value) && '' != $value): ?>
            <img style="position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; user-select: none; border: none; opacity: 0.1;" src="<?= $value ?>">
            <?php endif ?>
        </div>
        <input <?= implode(' ', $attributes) ?>>
        &nbsp; <button type="button" class="btn btn-primary" id="clear-<?= $this->getName() ?>" onclick="eraseSignature_<?= $this->getName() ?>()" title="Zeichenfläche leeren"><i class="bi-eraser"></i></button>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        initSignature_<?= $this->getName() ?>();
    });

    function initSignature_<?= $this->getName() ?>() {
        let base_id = "canvas-<?= $this->getName() ?>",
            canvas = document.getElementById("canvas-<?= $this->getName() ?>"),
            target = document.getElementById('canvas-target-<?= $this->getName() ?>'),
            ctx,
            flag = false,
            dot_flag = false,
            prevX = 0,
            currX = 0,
            prevY = 0,
            currY = 0;

        let x = "black",
            y = 2;

        ctx = canvas.getContext("2d");
        w = canvas.width = canvas.style.width;
        h = canvas.height = canvas.style.height;

        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);

        function draw() {
            let offset = canvas.getBoundingClientRect();
            let scrollTop = window.scrollY;
            let scrollLeft = window.scrollX;

            //console.log((prevX - offset.left + scrollLeft)+" | "+(prevY - offset.top + scrollTop)+" | "+(currX - offset.left + scrollLeft)+" | "+(currY - offset.top + scrollTop));

            ctx.beginPath();
            ctx.moveTo(prevX - offset.left + scrollLeft, prevY - offset.top + scrollTop);
            ctx.lineTo(currX - offset.left + scrollLeft, currY - offset.top + scrollTop);
            ctx.strokeStyle = x;
            ctx.lineWidth = y;
            ctx.stroke();
            ctx.closePath();

            // push result to input hidden
            target.value = canvas.toDataURL();
        }

        function findxy(res, e) {
            if (res == 'down') {
                prevX = currX;
                prevY = currY;
                currX = e.clientX;
                currY = e.clientY;

                flag = true;
                dot_flag = true;

                if (dot_flag) {
                    ctx.beginPath();
                    ctx.fillStyle = x;
                    ctx.fillRect(currX, currY, 2, 2);
                    ctx.closePath();
                    dot_flag = false;
                }
            }
            if (res == 'up' || res == "out") {
                flag = false;
            }
            if (res == 'move') {
                if (flag) {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX;
                    currY = e.clientY;
                    draw();
                }
            }
        }
    }

    function eraseSignature_<?= $this->getName() ?>() {
        let m = confirm("Zeichenfläche wirklich löschen?");

        if (m) {
            document.getElementById('#canvas-<?= $this->getName() ?>').getContext('2d').clearRect(0, 0, w, h);
        }
    }
</script>
