<?php

namespace Alexplusde\BS5;

/** @var \rex_fragment $this */

use rex_config;
use rex_clang;

if(!Helper::packageExists('search_it')) {
    echo \rex_view::error('Das Addon "search_it" ist nicht installiert oder aktiviert!');
    return;
}

?>
<!-- BEGIN bs5/template/breadcrumb-search.php  -->
<?php $article_id = rex_config::get('plus_bs5', 'search_article_id');
?>
<form class="d-flex" role="search" id="breadcrumb_search_it" action="<?php echo rex_getUrl($article_id, rex_clang::getCurrentId()); ?>" method="get">
    <div class="input-group">
        <!-- <label for="breadcrumb_search_it_input" class="form-label">{{ template.breadcrumb_search.label }}</label>-->
        <input name="q" type="search" aria-label="Search" value="<?= rex_escape(rex_request('q', 'string', '')); ?>" class="form-control" list="breadcrumb_search_it_datalist" id="exampleDataList" placeholder="{{ template.breadcrumb_search.placeholder }}">
        <datalist id="breadcrumb_search_it_datalist">
            <option value="iServ">
            <option value="Ferien">
            <option value="Kontakt">
            <option value="Termine">
        </datalist>
        <input class="btn btm-primary" type="submit" value="{{ template.breadcrumb_search.submit }}" />
    </div>
</form>
<!-- END bs5/template/breadcrumb-search.php  -->
