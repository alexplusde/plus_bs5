# Bootstrap 5 Module und Templates für REDAXO 5

> NOCH NICHT FÜR DEN PRODUKTIVEINSATZ GEDACHT!

Projektübergreifende Bootstrap 5 Module und Templates für REDAXO

In diesem Addon befinden sich Vorlagen für Bootstrap 5-Module und Templates in Form von Fragmenten und Hilfsklassen.

Bootstrap 5 selbst wird mitinstalliert, kann jedoch auch von Entwicklern händisch oder über einen eigenen Build-Prozess ersetzt und angepasst werden.

Templates und deren Fragmente können in eigenen Addons überschrieben werden.

## Namensschema

Alle Module und Templates erhalten das Namensschema `bs5/xxxxx`, z.B. `bs5/text`, `bs5/image` usw.

Die Ordner-Struktur der Fragmente ist immer `/bs5/` + passende Fragmente, passend zum Namespace der Modul-Keys und Tempalte-Keys.

z.B. `/bs5/text` als Modul-Key sucht nach `/bs5/text.php` als Ausgabe-Fragment.

## Template-Struktur

### `Standard [1]`

Ein Tempalte, das die wichtigsten Elemente einbindet, die für den Betrieb notwendig sind:
`template/head.php`, `template/header.php`, `template/main.php` und `template/footer.php`

### `Wartung [2]`

Ein Template, das verwendet wird, wenn der Maintenance-Modus aktiv ist.

### `Nur Logo [3]`

Ein Template, das wie `Standard [1]` funktioniert, jedoch kein Navigationsmenü ausgibt.

## Module

### Grundsätzliches zum Aufabeu der Module Values

Die *Eingabe* wird i.d.R. über MForm gebaut. Die *Ausgabe findet ausschließlich in Fragmenten statt und enthält grundsätzlich die REX_SLICE_ID und REX_ARTICLE_ID. Bsp.:

#### Ausgabe

```php
if (!bs5::packageExists('ride', 'url', 'yform')) {
    return;
};

$output = new bs5_fragment();
$output->setVar("slice_id", "REX_SLICE_ID");
$output->setVar("article_id", "REX_ARTICLE_ID");
$output->setVar("modul_name", "REX_MODULE_KEY");

$output->setVar("image", "REX_MEDIA[1]");

echo $output->parse('bs5/image.php');

unset($output);
```

Die Labels sollten, wenn möglich, mehrspachig sein, da die Module auch mehrsprachig eingesetzt werden:

```php
$field->setLabel('translate:test');
```

#### Eingabe

bei der Eingabe wird zunächst auf verfügbare verwendete Pakete geprüft, um ein Whoops im Backend zu verhindern, sollten diese Pakete nicht mehr installiert sein.

```php
# Dieses Modul wird über das Addon plus_bs5 verwaltet und geupdatet.
# Um das Modul zu entkoppeln, ändere den Modul-Key in REDAXO

if (!bs5::packageExists('media_manager', 'media_manager_profile')) {
    return;
}
```

#### REX_VALUES

| VALUE            | Beschreibung                             | Ausgabe                     | Fragment / Ausgabe                                                      |
|------------------|------------------------------------------|-----------------------------|-------------------------------------------------------------------------|
| REX_VALUE[1]     | Überschriften                            | Text                        | `$output->setVar("title", "REX_VALUE[1]", false);`                      |
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
| REX_MEDIA[2]     | Hintergrund                              | Dateiname                   | `$output->setVar("bg_image", "REX_MEDIA[1]", false);`                   |
| REX_MEDIA[3]     | Hintergrund (mobil)                      | Dateiname                   | `$output->setVar("bg_image_mobile", "REX_MEDIA[1]", false);`            |
|                  |                                          |                             |                                                                         |
| REX_MEDIALIST[1] | Bilder / Dateien (z.B. Downloads)        | Dateinamen, kommasepariert  | `$output->setVar("images", "REX_MEDIALIST[1]", false);`                 |

## Fragmente

Die Ordner-Struktur der Fragmente ist immer `/bs5/` + passende Fragmente, passend zum Namespace der Modul-Keys.

z.B. `/bs5/text` als Modul-Key sucht nach `/bs5/text.php` als Ausgabe-Fragment.

## Credits

* Alexander Walther für Fragmente, Module und Templates
* Norbert Micheel für das passende YForm Bootstrap Template
