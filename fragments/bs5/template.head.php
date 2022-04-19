<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?= domain::getHead(); ?>
<link rel="stylesheet" href="/assets/styles/style.css">
<?php
    $speed_up = new speed_up();
    $speed_up->show();
    ?>
<?php
    if (rex_addon::get('consent_manager') && rex_addon::get('consent_manager')->isAvailable()) { ?>
<?php
        $consented = '';
        if (isset($_COOKIE['consent_manager'])) {
            $cookieData = json_decode($_COOKIE['consent_manager'], true);
            $consented = str_replace('google-analytics', 'statistic', implode(' ', $cookieData['consents']));
        }
        echo '<script>var consent_manager_consented = \''.$consented.'\';</script>';
    }
?>
<?= consent_manager_frontend::getFragment(false, 'consent_manager_box_cssjs.php');
