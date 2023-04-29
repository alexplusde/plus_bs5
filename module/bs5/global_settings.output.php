<section class="modul modul-bs-global-settings py-5">
	<div class="container bg-white p-3 bs5-text shadow">
		<?php
    
$field = rex_sql::factory()->getArray("SELECT F.title as title, F.name as name, T.label as type FROM rex_global_settings_field F LEFT JOIN rex_global_settings_type T on F.type_id = T.id WHERE name = :name ORDER BY title", ["name" => "REX_VALUE[1]"]);
		/*
		switch ($field[0]["type"]) {
		    case "textarea":
		        echo rex_global_settings::getValue($field[0]['name']);
		        break;
		    case "text":
		        break;
		    case "REX_MEDIA_WIDGET":
		        break;
		    case "REX_MEDIALIST_WIDGET":
		        break;
		    case "REX_LINK_WIDGET":
		        break;
		    case "REX_LINKLIST_WIDGET":
		        break;
		    default:
		        break;
		} */
		?>
	</div>
</section>