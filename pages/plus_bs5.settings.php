
<div class="row">
    <div class="col-lg-8">

</div>
    <div class="col-lg-4">
        <?php

$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=plus_bs5"><img src="'.rex_url::addonAssets('plus_bs5', 'jetzt-spenden.svg').'" style="width: 100% max-width: 400px;"></a>';

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('plus_bs5_donate'), false);
$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5_info_donate') . '</p>' . $anchor, false);
echo $fragment->parse('core/page/section.php');
?>
    </div>
</div>
