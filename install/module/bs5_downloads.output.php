<?php

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'mediapool', 'media_manager'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* TODO: @alxndr-w Nicht mehr in JSON-Array speichern für Interoperabilität der Module */
$modul = rex_var::toArray("REX_VALUE[1]");
$files = array_filter(explode(",", "REX_MEDIALIST[1]"));

?>
<section class="modul modul-downloads" id="modul-REX_SLICE_ID">
    <?php

    #### Title ####
    if ($modul['show_title']) {
        echo '<h2 class="h3 my-3 mt-5">';
        if ($modul['title']) {
            echo $modul['title'];
        } else {
            "{{ modul:downloads:title }}";
        }
        echo '</h2>';
    }

#### Teaser ####
if ($modul['teaser']) {
    echo '<p class="teaser">';
    echo $modul['teaser'];
    echo '</p>';
}

#### Files ####
if (count($files)) {
    ?>
        <ul class="list-unstyled row">
            <?php
            foreach ($files as $file) {
                $media = rex_media::get($file);
                if (is_object($media)) {
                    if ($media->getTitle()) {
                        $title = $media->getTitle();
                    } else {
                        $title = $file;
                    } ?>
                    <li class="download col-md-6">

                        <?php
                        $download_fragment = new Fragment();
                    $download_fragment->setVar('title', $media->getTitle());
                    $download_fragment->setVar('file', $file);
                    $download_fragment->setVar('layout', 'default');
                    $download_fragment->setVar('extension', $media->getExtension());
                    $download_fragment->setVar('description', $media->getValue('description'));
                    $download_fragment->setVar('filesize', $media->getFormattedSize());

                    echo $download_fragment->parse('bs5/downloads/index.php'); ?>
                    </li>
            <?php
                } // is_object()
            } // foreach ($files as $file)
    ?>
        </ul>
    <?php
} // if (count($files))
?>
</section>
