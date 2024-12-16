<?php

namespace Alexplusde\BS5;

/** @var rex_fragment|Fragment $this */


use Alexplusde\BS5\Helper as BS5Helper;
use rex;
use rex_addon;
use rex_article;
use rex_sql;
use rex_yrewrite;
use search_it;
use Url\Profile;

?>
<!-- BEGIN plus_bs5/fragments/bs5/search_it/index.php -->
<?php

if (!BS5Helper::packageExists(['search_it'])) {
    echo \rex_view::error('Das Addon "search_it" ist nicht installiert oder aktiviert!');
    return;
}

echo $this->subfragment('bs5/search_it/form.php');

$article_id = rex_article::getCurrentId();
$request = rex_request('q', 'string', false);

if ($request) { // Wenn ein Suchbegriff eingegeben wurde
    $server = rtrim(rex::getServer(), '/');

    echo '<section class="search_it-hits" data-search_it="noindex">';

    // Init search and execute
    $search_it = new search_it();
    $result = $search_it->search($request);

    echo '<h2 class="search_it-headline">Suchergebnisse</h2>';
    if ($result['count'] > 0) {
        echo '<ul class="list-unstyled">';
        foreach ($result['hits'] as $hit) {
            if ('url' == $hit['type']) {
                // url hits
                $url_sql = rex_sql::factory();
                $url_sql->setTable(search_it_getUrlAddOnTableName());
                $url_sql->setWhere(['url_hash' => $hit['fid']]);
                if ($url_sql->select('article_id, clang_id, profile_id, data_id, seo')) {
                    if ($url_sql->getRows() > 0) {
                        $url_info = json_decode($url_sql->getValue('seo'), true);
                        $url_profile = Profile::get($url_sql->getValue('profile_id'));

                        // get yrewrite article domain
                        $hit_server = $server;
                        if (rex_addon::get('yrewrite')->isAvailable()) {
                            $hit_domain = rex_yrewrite::getDomainByArticleId($url_sql->getValue('article_id'), $url_sql->getValue('clang_id'));
                            $hit_server = rtrim($hit_domain->getUrl(), '/');
                        }

                        $hit_link = $hit_server . rex_getUrl($url_sql->getValue('article_id'), $url_sql->getValue('clang_id'), [$url_profile->getNamespace() => $url_sql->getValue('data_id'), 'search_highlighter' => $request]);

                        $this->setVar('hit', $hit, false);
                        $this->setVar('hit_server', $hit_server);
                        $this->setVar('hit_link', $hit_link);
                        $this->setVar('hit_title', $url_info['title']);
                        $this->setVar('url_info', $url_info, false);
                        $this->setVar('url_sql', $url_sql, false);
                        $this->setVar('url_profile', $url_profile);

                        echo $this->subfragment('bs5/search_it/result-item-url.php');
                    }
                }
            }

            if ('article' == $hit['type']) {
                // article hits
                $article = rex_article::get($hit['fid'], $hit['clang']);
                if ($article) {
                    // get yrewrite article domain
                    $hit_server = $server;
                    if (rex_addon::get('yrewrite')->isAvailable()) {
                        $hit_domain = rex_yrewrite::getDomainByArticleId($article->getId(), $article->getClang());
                        $hit_server = rtrim($hit_domain->getUrl(), '/');
                    }

                    $hit_link = $server . rex_getUrl($article->getId(), $article->getClang(), ['search_highlighter' => $request]);


                    $this->setVar('hit', $hit, false);
                    $this->setVar('hit_server', $hit_server);
                    $this->setVar('title', $article->getName());
                    $this->setVar('hit_link', $hit_link);

                    
                    echo $this->subfragment('bs5/search_it/result-item-article.php');
                }
            }

        }
        echo '</ul>';
    } elseif (!$result['count']) {
        echo '<p class="search_it-zero">Keine Suchergebnisse gefunden.</p>';
    }
    echo '</section>';
}

?>
<!-- END plus_bs5/fragments/bs5/search_it/index.php -->
