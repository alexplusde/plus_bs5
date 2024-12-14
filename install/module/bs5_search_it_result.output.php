<?php

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['search_it'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* Instruktionen */
Helper::showBackendUserInstruction("Für die Suchfunktion wird ein aktueller Index der Seite im Add-on 'search_it' benötigt.", Helper::getBackendPageLink('search_it'));

?>
<?php
# Legacy Modul
        $server = rtrim(rex::getServer(), "/");
$request = rex_request('search', 'string', false);
        
if ($request) {
    $search_it = new search_it();
    $result = $search_it->search($request);
            
    if ($result['count']) {
        echo '<h2 class="search_it-label">{{ search_it:results }}: '.$result['count'].'</h2>';
                
        echo '<ul class="search_it-results">';
        foreach ($result['hits'] as $hit) {
            if ($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'article') {
                $text = $hit['article_teaser'];
            } else {
                $text = $hit['highlightedtext'];
            }
                    
            /* Redaxo-Artikel via Datenbank / Metadaten */
            if (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'article') || ($hit['type'] == 'article')) {
                if ($article = rex_article::get($hit['fid'])) {
                    $searchitem_fragment = new Fragment();
                    $searchitem_fragment->setVar('type', 'rex_article');
                    $searchitem_fragment->setVar('title', $article->getName());
                    $searchitem_fragment->setVar('url', $article->getUrl());
                    $searchitem_fragment->setVar('teaser', $text);
                    $searchitem_fragment->setVar('icon', false);
                    $searchitem_fragment->setVar('extension', false);
                    $searchitem_fragment->setVar('thumbnail', '/media/search_it-result-default.svg');
                    $searchitem_fragment->setVar('label', '');

                    echo $searchitem_fragment->parse('search-result-item.tpl.php');
                }
                        
                /* Medium über Treffer in Datenbanktabelle rex_media */
                /* Todo: Nur für Suche indexierte Dateien freigeben */
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'media') || ($hit['type'] == 'media')) {
                if ($media = rex_media::get($hit['values']['originalname'])) {
                    $searchitem_fragment = new Fragment();
                    $searchitem_fragment->setVar('type', 'rex_media');
                    $searchitem_fragment->setVar('title', $media->getTitle());
                    $searchitem_fragment->setVar('url', 'download/'.$media->getFileName());
                    $searchitem_fragment->setVar('teaser', $hit['highlightedtext']);
                    $searchitem_fragment->setVar('extension', $media->getExtension());
                    $searchitem_fragment->setVar('icon', 'file');
                    $searchitem_fragment->setVar('thumbnail', false);
                    $searchitem_fragment->setVar('label', '');
                            
                    echo $download_fragment->parse('search-result-item.tpl.php');
                }
                        
                /* AG-Treffer */
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'school_projects')) {
                $searchitem_fragment = new Fragment();
                $searchitem_fragment->setVar('type', 'school_projects');
                $searchitem_fragment->setVar('title', $hit['name']);
                $searchitem_fragment->setVar('url', $article->getUrl());
                $searchitem_fragment->setVar('teaser', $hit['description']);
                $searchitem_fragment->setVar('icon', 'schoool_project');
                $searchitem_fragment->setVar('extension', false);
                $searchitem_fragment->setVar('thumbnail', $hit['image']);
                $searchitem_fragment->setVar('label', 'GTB');
                            
                echo $searchitem_fragment->parse('search-result-item.tpl.php');
                            
                /* Termin-Treffer */
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'school_events')) {
                $searchitem_fragment = new Fragment();
                $searchitem_fragment->setVar('type', 'school_events');
                $searchitem_fragment->setVar('title', $hit['name']);
                $searchitem_fragment->setVar('url', rex_getUrl('', '', ['event-id' => $hit['fid']]));
                $searchitem_fragment->setVar('teaser', $text);
                $searchitem_fragment->setVar('icon', 'school_event');
                $searchitem_fragment->setVar('extension', false);
                $searchitem_fragment->setVar('thumbnail', false);
                $searchitem_fragment->setVar('label', 'Veranstaltung');
                            
                echo $searchitem_fragment->parse('search-result-item.tpl.php');
                        
                /* Ansprechpartner-Treffer */
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'school_team')) {
                $thumbnail = '';
                if (!$thumbnail = $hit['values']['Bild']) {
                    $thumbnail = '/media/team-person-default.jpg';
                }
                            
                $searchitem_fragment = new Fragment();
                $searchitem_fragment->setVar('type', 'school_team');
                $searchitem_fragment->setVar('title', $hit['values']['name']);
                $searchitem_fragment->setVar('url', rex_getUrl('', '', ['team-id' => $hit['fid']]));
                $searchitem_fragment->setVar('teaser', $text);
                $searchitem_fragment->setVar('icon', false);
                $searchitem_fragment->setVar('extension', false);
                $searchitem_fragment->setVar('thumbnail', $thumbnail);
                $searchitem_fragment->setVar('label', 'Ansprechpartner');
                            
                echo $searchitem_fragment->parse('search-result-item.tpl.php');
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'school_rooms')) {
                $searchitem_fragment = new Fragment();
                $searchitem_fragment->setVar('type', 'school_rooms');
                $searchitem_fragment->setVar('title', $hit['values']['name']);
                $searchitem_fragment->setVar('url', rex_getUrl('', '', ['room-id' => $hit['fid']]));
                $searchitem_fragment->setVar('teaser', $hit['values']['title']);
                $searchitem_fragment->setVar('icon', 'school_room');
                $searchitem_fragment->setVar('extension', false);
                $searchitem_fragment->setVar('thumbnail', 'room');
                $searchitem_fragment->setVar('label', 'Raumplan');
                            
                echo $searchitem_fragment->parse('search-result-item.tpl.php');
            } elseif (($hit['type'] == 'db_column' and $hit['table'] == rex::getTablePrefix().'school_courses')) {
                $searchitem_fragment = new Fragment();
                $searchitem_fragment->setVar('type', 'school_courses');
                $searchitem_fragment->setVar('title', $hit['values']['name']);
                $searchitem_fragment->setVar('url', rex_getUrl('', '', ['course-id' => $hit['fid']]));
                $searchitem_fragment->setVar('teaser', $hit['description']);
                $searchitem_fragment->setVar('icon', 'school_courses');
                $searchitem_fragment->setVar('extension', false);
                $searchitem_fragment->setVar('thumbnail', 'course');
                $searchitem_fragment->setVar('label', 'Fach');
                            
                echo $searchitem_fragment->parse('search-result-item.tpl.php');
            }
        } // foreach($result['hits'] as $hit) END
        echo '</ul>';
    } elseif (!$result['count']) { // Wenn keine Ergebnisse vorhanden sind....
        echo '<p class="search_it-no_result">Die Suche nach <i class="search_it-request">'.$request.' </i> ergab keine Treffer.</p>';
    }
} // if($request) END
?>
</section>
