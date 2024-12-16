<?php

$addon = rex_addon::get('plus_bs5');

$form = rex_config_form::factory($addon->name);

$field = $form->addSelectField('dev');
$field->setLabel($this->i18n('bs5_config_dev_label'));
$field->setNotice($this->i18n('bs5_config_dev_notice'));
$select = $field->getSelect();
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_dev_active'), '1');
$select->addOption($this->i18n('bs5_config_dev_inactive'), '0');

$fragment = new rex_fragment();
$fragment->setVar('class', 'danger', false);
$fragment->setVar('title', $this->i18n('bs5_config_settings'), false);
$fragment->setVar('body', $form->get(), false);

$output = $fragment->parse('core/page/section.php');

$fonts = [];
$fonts_socket = rex_socket::factoryUrl('https://api.fontsource.org/fontlist?family');
$response = $fonts_socket->doGet();
if ($response->isOk()) {
	$fonts = json_decode($response->getBody(), true);
}

$select = new \rex_select();
$select->setName('font');
$select->setAttribute('class', 'form-control selectpicker');
$select->setSize(1);
$select->addOption($this->i18n('bs5_config_font_default'), 'default');
foreach ($fonts as $family => $font) {
	$select->addOption($font . " (" . $family . ")", $family);
}


$form = '';
$form .= '<form action="' . rex_url::currentBackendPage() . '" method="POST">';
$form .= '<input type="hidden" name="func" value="fonts" />';
$form .= '<div class="form-group">';
$form .= '<label for="font">' . $this->i18n('bs5_config_font_label') . '</label>';
$form .= $select->get();
$form .= '</div>';
$form .= '<button type="submit" class="btn btn-primary">' . $this->i18n('bs5_config_font_submit') . '</button>';
$form .= '</form>';

if (rex_request::post('func', 'string', '') === 'fonts' && rex_request::post('font', 'string', '') !== "") {
	$font_id = rex_request::post('font', 'string');
	$font_socket = rex_socket::factoryUrl('https://api.fontsource.org/v1/fonts/' . $font_id);
	$response = $font_socket->doGet();
	if ($response->isOk()) {
		$font = json_decode($response->getBody(), true);

		$family = $font['family'];
		$family_id = $font['id'];
		$unicodeRange = $font['unicodeRange']['latin-ext'];
		$css = '';
		foreach ($font['variants'] as $weight => $styles) {
			foreach ($styles as $style => $subsets) {
				if (isset($subsets['latin-ext'])) {

					$url_woff2 = rex_url::addonAssets('project', 'fonts' . '/' . $family_id . '/' . $style . '-' . $weight . '.woff2');
					$url_woff = rex_url::addonAssets('project', 'fonts' . '/' . $family_id . '/' . $style . '-' . $weight . '.woff');
					$url_ttf = rex_url::addonAssets('project', 'fonts' . '/' . $family_id . '/' . $style . '-' . $weight . '.ttf');

					rex_file::put($url_woff2, file_get_contents($subsets['latin-ext']['url']['woff2']));
					rex_file::put($url_woff, file_get_contents($subsets['latin-ext']['url']['woff']));
					rex_file::put($url_ttf, file_get_contents($subsets['latin-ext']['url']['ttf']));

					$urls = $subsets['latin-ext']['url'];
					$css .= "@font-face {\n";
					$css .=  "    font-family: '{$family}';\n";
					$css .= "    font-style: {$style};\n";
					$css .= "    font-weight: {$weight};\n";
					$css .= "    font-display: swap;\n";
					$css .= "    src: url('{$url_woff2}') format('woff2'),\n";
					$css .= "         url('{$url_woff}') format('woff'),\n";
					$css .= "         url('{$url_ttf}') format('truetype');\n";
					$css .= "    unicode-range: {$unicodeRange};\n";
					$css .= "}\n\n";

				}
			}
		}
		
		$css_file = rex_path::addonAssets('project', 'fonts' . '/' . $family_id  . '.css');
		if(rex_file::put($css_file, $css) === true) {
			echo rex_view::success($this->i18n('bs5_config_font_success'));
		} else {
			echo rex_view::error($this->i18n('bs5_config_font_error'));
		}
	}
}

$fragment = new rex_fragment();
$fragment->setVar('class', 'info', false);
$fragment->setVar('title', $this->i18n('bs5_config_font_title'), false);
$fragment->setVar('body', $form, false);
$output .= $fragment->parse('core/page/section.php');

?>
<div class="row">
	<div class="col-lg-8">
		<?= $output ?>
	</div>

	<div class="col-lg-4">
		<?php

		$anchor = '<a target="_blank" href="https://donate.alexplus.de/?addon=plus_bs5"><img src="' . rex_url::addonAssets('plus_bs5', 'jetzt-beauftragen.svg') . '" style="width: 100% max-width: 400px;"></a>';

		$fragment = new rex_fragment();
		$fragment->setVar('class', 'info', false);
		$fragment->setVar('title', $this->i18n('plus_bs5.settings.donate'), false);
		$fragment->setVar('body', '<p>' . $this->i18n('plus_bs5.settings.info_donate') . '</p>' . $anchor, false);
		echo $fragment->parse('core/page/section.php');
		?>
	</div>
</div>
