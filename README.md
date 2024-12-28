# Bootstrap 5 Module und Templates für REDAXO 5

Projektübergreifende Bootstrap 5 Module und Templates für REDAXO

In diesem Addon befinden sich Vorlagen für Bootstrap 5-Module und Templates in Form von Fragmenten und Hilfsklassen.

Bootstrap 5 selbst wird mitinstalliert, kann jedoch auch von Entwicklern händisch oder über einen eigenen Build-Prozess ersetzt und angepasst werden.

Templates und deren Fragmente können in eigenen Addons überschrieben werden. 

## Namensschema

Alle Module und Templates erhalten das Namensschema `bs5.xxxxx`, z.B. `bs5.text`, `bs5.image` usw.

Die Ordner-Struktur der Fragmente ist immer `/bs5/` + passende Fragmente, passend zum Namespace der Modul-Keys und Tempalte-Keys.

z.B. `bs5.text` als Modul-Key sucht nach `bs5/text/index.php` als Ausgabe-Fragment.

## Template-Struktur

### `Standard [1]`

Ein Tempalte, das die wichtigsten Elemente einbindet, die für den Betrieb notwendig sind:
`template/head.php`, `template/header.php`, `template/main.php` und `template/footer.php`

![image](https://github.com/user-attachments/assets/ff975cd1-561c-4e2b-924f-b8ee7cc08c53)

### `Wartung [2]`

Ein Template, das verwendet wird, wenn der Maintenance-Modus aktiv ist.

### `Nur Logo [3]`

Ein Template, das wie `Standard [1]` funktioniert, jedoch kein Navigationsmenü ausgibt.

## Module

### Grundsätzliches zum Aufbau der Module Values

![image](https://github.com/user-attachments/assets/6b8ba2a1-2fba-4deb-9f69-3828ca3ae6fc)

Die **Eingabe** wird i.d.R. über MForm gebaut. Die **Ausgabe** findet ausschließlich in Fragmenten statt und enthält grundsätzlich die REX_SLICE_ID und REX_ARTICLE_ID. Dadurch lassen sich Ausgaben auch nachträglich über den Prozess im Installer updaten. Mehr Infos dazu unter <https://github.com/alexplusde/tracks/>.

Unter [https://chatgpt.com/g/g-cYIHRaDWy-steve-redaxo-mform-builder](https://chatgpt.com/g/g-cYIHRaDWy-steve-redaxo-mform-builder) findest du ein angepasstes ChatGPT-Modell für Modul-Eingabe und -Ausgabe.

Bsp.:

#### Ausgabe

```php
<?php

use Alexplusde\BS5\Fragment;
use Alexplusde\BS5\Helper;

/* Benötigte Addons */
$requiredAddons = ['school', 'mform'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/** Variablen */
$modul = rex_var::toArray("REX_VALUE[1]");
$modul_yform = rex_var::toArray("REX_VALUE[2]");

/* Fragment */
$fragment = new Fragment();
$fragment->setVar('slice_id', "REX_SLICE_ID");

/* Modulspezifische Variablen */
$fragment->setVar('headline' , "REX_VALUE[1]");
$fragment->setVar('headline_level' , "REX_VALUE[2]");
$fragment->setVar('text' , "REX_VALUE[4 output=html]", false);
$fragment->setVar('cta' , "REX_VALUE[8 output=html]", false);
$fragment->setVar('image' , "REX_MEDIA[1]");

/* Ausgabe */
echo $fragment->parse('bs5/text/index.php');

?>
```

Eigene Labels sollten, wenn möglich, mehrspachig sein, da die Module auch mehrsprachig eingesetzt werden:

```php
$field->setLabel('translate:test');
```

#### Eingabe

bei der Eingabe wird zunächst auf verfügbare verwendete Pakete geprüft, um ein Whoops im Backend zu verhindern, sollten diese Pakete nicht mehr installiert sein.

```php
<?php

/**
 * Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
 * Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO. Um die 
 * Ausgabe zu verändern, genügt es, das passende Fragment zu überschreiben.
 */

use Alexplusde\BS5\Helper;
use Alexplusde\BS5\MForm as BS5MForm;
use FriendsOfRedaxo\MForm;

/* Addon-Prüfung */
$requiredAddons = ['mform', 'redactor'];
if (!Helper::packageExists($requiredAddons)) {
    echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', implode(', ', $requiredAddons)));
    return;
};

/* MForm-Formular */
$mform = BS5MForm::defaultFactory();

echo $mform->show();
```

Durch die  Methode `packageExists() wird eine passende Fehlermeldung ausgegeben.

#### REX_VALUES

| VALUE            | Beschreibung                             | Ausgabe                     | Fragment / Ausgabe                                                      |
|------------------|------------------------------------------|-----------------------------|-------------------------------------------------------------------------|
| REX_VALUE[1]     | Überschriften                            | Text                        | `$output->setVar("headline", "REX_VALUE[1]", false);`                      |
| REX_VALUE[2]     | Überschriften-Ebene (h1, h2, h3)         | Tag / Attribut              | `$output->setVar("level", "REX_VALUE[2]", false);`                      |
| REX_VALUE[3]     | Teaser (Kurztext)                        | Text                        | `$output->setVar("teaser", "REX_VALUE[3]", false);`                     |
| REX_VALUE[4]     | Langtext                                 | HTML                        | `$output->setVar("text", "REX_VALUE[4 output="html"]", false);`         |
| REX_VALUE[5]     | Langtext 2 (oder Sonstiges)              | HTML                        | `$output->setVar("text2", "REX_VALUE[5 output="html"]", false);`        |
| REX_VALUE[6]     | Langtext 3 (oder Sonstiges)              | HTML                        | `$output->setVar("text3", "REX_VALUE[6 output="html"]", false);`        |
| REX_VALUE[7]     | Langtext 4 (oder Sonstiges)              | HTML                        | `$output->setVar("text4", "REX_VALUE[7 output="html"]", false);`        |
| REX_VALUE[8]     | CTA-Button (oder Sonstiges)              | HTML                        | `$output->setVar("cta", "REX_VALUE[8 output="html"]", false);`          |
| REX_VALUE[9]     | Ausgabe-Optionen (via Checkbox / Select) | Attribut(e), kommasepariert | `$output->setVar("options", "REX_VALUE[9]", false);`                    |
| REX_VALUE[10]    | Ausgabe-Optionen (Fragmente)             | Dateipfad                   | `$output->setVar("fragment", "REX_VALUE[10]", false);`                  |
|                  |                                          |                             |                                                                         |
| REX_MEDIA[1]     | Bild / Datei                             | Dateiname                   | `$output->setVar("image", "REX_MEDIA[1]", false);`                      |
| REX_MEDIA[2]     | Hintergrund                              | Dateiname                   | `$output->setVar("bg_image", "REX_MEDIA[2]", false);`                   |
| REX_MEDIA[3]     | Hintergrund (mobil)                      | Dateiname                   | `$output->setVar("bg_image_mobile", "REX_MEDIA[3]", false);`            |
|                  |                                          |                             |                                                                         |
| REX_MEDIALIST[1] | Bilder / Dateien (z.B. Downloads)        | Dateinamen, kommasepariert  | `$output->setVar("images", "REX_MEDIALIST[1]", false);`                 |
|                  |                                          |                             |                                                                         |
| REX_LINK[1]      | Kategorie                                | Dateiname                   | `$output->setVar("category", "REX_LINK[1]", false);`                    |
| REX_LINK[2]      | Ein Artikel                              | Dateiname                   | `$output->setVar("article", "REX_LINK[2]", false);`                     |
|                  |                                          |                             |                                                                         |
| REX_LINKLIST[1]  | Kategorien                               | Dateiname                   | `$output->setVar("categories", "REX_LINKLIST[1]", false);               |
| REX_LINKLIST[2]  | Artikel                                  | Dateiname                   | `$output->setVar("articles", "REX_LINKLIST[2]", false);`                |

### Modul `Fragen & Antworten` (`bs5/qanda/list`)

> Eine Liste von Fragen und Antworten aus dem Addon `qanda`. Benötigt `mform`, `qanda`.

## Fragmente

Die Ordner-Struktur der Fragmente ist immer `/bs5/` + passende Fragmente, passend zum Namespace der Modul-Keys.

z.B. `/bs5/text` als Modul-Key sucht nach `/bs5/text.php` als Ausgabe-Fragment.

### Subfragmente

Einige Module und Templates bieten zusätzlich eine Layout-Optionswahl aus, z.B. Kategorien-Übersicht, Artikelübersicht, Bildergalerie, Bilder und Video. dabei werden Unterordner mit den jeweiligen Layouts erstellt und als Subfragment aufgerufen.

## Hilfsklassen und Methoden

### `bs5::packageExists()`

Überprüft, ob bestimmte REDAXO-Addons installiert und aktiviert sind, bevor sie aufgerufen werden. Gibt eine Fehlermeldung aus, wenn dies nicht der Fall ist. Hauptsächlich eingsetzt in Modul-Eingabe und Modul-Ausgabe.

### `bs5::updateModule()`, `bs5::updateTemplate()`

Werden beim Installieren und Updaten des Addons aufgerufen, um die neuste Version der Moduleingaben und Ausgaben zu installieren.

Diese Methode kann auch für darauf aufbauende Addons verwendet werden. Beispiele dazu finden sich in der install.php und update.php des Addons `stellenangebote`.

### `bs5::writeModule()`, `bs5::writeTemplate()`

Für Addon-Entwickler: Schreibt die neusten Module und Templates ins Dateisystem des Addons. Benötigt aktivierten Debug-Modus und aktivierten Schreib-Modus im Addon.

Diese Methode kann auch für darauf aufbauende Addons verwendet werden. Beispiele dazu finden sich in der install.php und update.php des Addons `stellenangebote`.

### `bs5::forceBackup()`

Für Addon-Entwickler: Schreibt von Modulen und Templates Backups Addons. Benötigt aktivierten Debug-Modus und aktivierten Schreib-Modus im Addon.

Diese Methode kann auch für darauf aufbauende Addons verwendet werden. Beispiele dazu finden sich in der install.php und update.php des Addons `stellenangebote`.

### `bs5::getConfig($key)` und `bs5::setConfig($key, $value)`

Shortcut zum Aufrufen von `rex_config::get('plus_bs5', $key)` und `rex_config::set('plus_bs5', $key, $value)`

## Weitere Empfehlungen

### CSP-Header setzen (Content Security Policy)

Aus Sicherheitsgründen sollte ein CSP-Header gesetzt werden, um XSS-Angriffe zu verhindern. Hier ein Beispiel für einen CSP-Header, der für die gesamte Website (Frontend) gilt. Der Header wird in der `.htaccess`-Datei des Servers gesetzt.

```htaccess
<IfModule mod_headers.c>
    # Set CSP header for the entire site
    Header set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: *.youtube.com *.google.com *.githubusercontent.com; font-src 'self' data:; connect-src 'self'; media-src 'self'; object-src 'none'; child-src 'none'; frame-src 'self' *.youtube-nocookie.com *.youtube.com *.google.com; worker-src 'self'; frame-ancestors 'none'; form-action 'self'; block-all-mixed-content; base-uri 'none'; manifest-src 'self'"

    # Unset CSP header for specific files in the subdirectory
    <FilesMatch "^/redaxo/.*$">
        Header unset Content-Security-Policy
    </FilesMatch>
</IfModule>
```

Youtube und Google (für Maps) sind hier als Beispiel für erlaubte Quellen für Bilder und Videos eingetragen. Die `*.google.com`-Quelle ist für Google Fonts. Die `*.githubusercontent.com`-Quelle ist für Bilder, die auf GitHub gehostet werden (Addon-Dokus).

unsafe-inline ist für die Verwendung von Inline-Styles und Inline-Scripts notwendig, da Add-ons wie Redactor oder Watson darauf zurückgreifen. Es sollte jedoch vermieden werden, Inline-Styles und Inline-Scripts zu verwenden, da dies die Sicherheit des Systems beeinträchtigen kann.

## Credits

* Alexander Walther für Fragmente, Module und Templates
