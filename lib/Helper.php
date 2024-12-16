<?php

namespace Alexplusde\BS5;

use DateTimeImmutable;
use rex;
use rex_addon;
use rex_article;
use rex_backend_login;
use rex_backup;
use rex_clang;
use rex_config;
use rex_file;
use rex_path;
use rex_sql;
use rex_string;
use rex_yform_manager;

class Helper
{
 
    public static function packageExists(array $packages): bool
    {
        $packages = explode(', ', array_pop($packages));
        foreach ($packages as $package) {
            if (!rex_addon::get($package) || true !== rex_addon::get($package)->isAvailable()) {
                return false;
            }
        }
        return true;
    }

    public static function getInstallOrUpdatePath(string $addon = 'plus_bs5', string $installFolder = 'module')
    {

        if (rex_addon::get($addon)->getProperty('is_update')) {
            return rex_path::src('addons' . \DIRECTORY_SEPARATOR . '.new.' . $addon . \DIRECTORY_SEPARATOR . 'install' . \DIRECTORY_SEPARATOR . $installFolder . \DIRECTORY_SEPARATOR);
        }
        return rex_path::src('addons' . \DIRECTORY_SEPARATOR . $addon . \DIRECTORY_SEPARATOR . 'install' . \DIRECTORY_SEPARATOR . $installFolder . \DIRECTORY_SEPARATOR);
    }

    public static function updateModule($addonName = 'plus_bs5')
    {
        $path = self::getInstallOrUpdatePath($addonName, 'module');
        $modules = preg_grep('~\.(json)$~', scandir($path));

        foreach ($modules as $module) {
            // Anstelle von .json ist die Endung .php für die Template-Datei
            $module_array = json_decode(rex_file::get($path . $module), 1);
            $module_array['input'] = rex_file::get($path . str_replace('.json', '.input.php', $module));
            $module_array['output'] = rex_file::get($path . str_replace('.json', '.output.php', $module));

            rex_sql::factory()->setDebug(0)->setTable('rex_module')
                ->setValue('name', $module_array['name'])
                ->setValue('key', $module_array['key'])
                ->setValue('input', $module_array['input'])
                ->setValue('output', $module_array['output'])
                ->setValue('createuser', 'plus_bs5')
                ->setValue('updateuser', 'plus_bs5')
                ->setValue('createdate', date('Y-m-d H:i:s'))
                ->setValue('updatedate', date('Y-m-d H:i:s'))
                ->insertOrUpdate();
        }
    }

    public static function writeModule($addonName = 'plus_bs5', $query = 'bs5.%')
    {
        $modules = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_module WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($modules as $module) {
            rex_file::put(rex_path::addon($addonName, 'install/module/' . rex_string::normalize($module['key']) . '.input.php'), $module['input']);
            rex_file::put(rex_path::addon($addonName, 'install/module/' . rex_string::normalize($module['key']) . '.output.php'), $module['output']);
            unset($module['input']);
            unset($module['output']);
            rex_file::put(rex_path::addon($addonName, 'install/module/' . rex_string::normalize($module['key']) . '.json'), json_encode($module, JSON_PRETTY_PRINT));
        }
    }

    public static function updateTemplate($addonName = 'plus_bs5')
    {
        $path = self::getInstallOrUpdatePath($addonName, 'template');

        $templates = preg_grep('~\.(json)$~', scandir($path));

        foreach ($templates as $template) {
            $template_array = json_decode(rex_file::get($path . $template), 1);
            // Anstelle von .json ist die Endung .php für die Template-Datei
            $template_array['content'] = rex_file::get($path . str_replace('.json', '.php', $template));
            rex_sql::factory()->setDebug(0)->setTable('rex_template')
                ->setValue('name', $template_array['name'])
                ->setValue('key', $template_array['key'])
                ->setValue('content', $template_array['content'])
                ->setValue('createuser', 'plus_bs5')
                ->setValue('updateuser', 'plus_bs5')
                ->setValue('createdate', date('Y-m-d H:i:s'))
                ->setValue('updatedate', date('Y-m-d H:i:s'))
                ->insertOrUpdate();
        }
    }

    public static function writeTemplate($addonName = 'plus_bs5', $query = 'bs5.%')
    {
        $templates = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_template WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($templates as $template) {
            rex_file::put(rex_path::addon($addonName, 'install/template/' . rex_string::normalize($template['key']) . '.php'), $template['content']);
            unset($template['content']);
            rex_file::put(rex_path::addon($addonName, 'install/template/' . rex_string::normalize($template['key']) . '.json'), json_encode($template, JSON_PRETTY_PRINT));
        }
    }

    public static function getConfig(string $key)
    {
        return rex_config::get('plus_bs5', $key);
    }

    public static function getConfigText(string $key): string
    {
        $text = self::getConfig($key);
        if (rex_addon::get('sprog')->isAvailable() && !rex::isSafeMode()) {
            if ($key != sprogdown($key)) {
                $text = sprogdown($key);
            }
        }
        if (null === $text) {
            return 'missing text for key <code>' . $key . '</code>';
        }

        return $text;
    }

    public static function forceBackup($prefix = 'plus_bs5', $type = 'update', $filename = '', $tables = ['rex_module', 'rex_template'])
    {
        $dir = rex_backup::getDir() . '/';

        if (!$filename) {
            $now = new DateTimeImmutable();
            $filename = $now->format('Y') . '-' . $now->format('m') . '-' . $now->format('d') . '_' . $now->format('H') . '-' . $now->format('i') . '-' . $now->format('s');
        }
        $file = $prefix . '_' . $filename . '.' . $type . '.sql';

        $exportFilePath = $dir . $file;

        if (rex_backup::exportDb($exportFilePath, $tables)) {
            return true;
        }
        return false;
    }

    public static function setConfig($key, $value)
    {
        rex_config::set('plus_bs5', $key, $value);
    }

    public static function getBackendPageLink(string $page): string
    {
        if (rex_backend_login::hasSession()) {
            return '<a class="badge bg-primary" href="/redaxo/index.php?page=' . $page . '">wechseln</a>';
        }
        return '';
    }

    public static function getBackendEditLink(?int $article_id = null, ?int $clang_id = null, ?int $slice_id = null, string $label = 'bearbeiten'): string
    {
        if (null === $article_id) {
            $article_id = rex_article::getCurrentId();
        }
        if (null === $clang_id) {
            $clang_id = rex_clang::getCurrentId();
        }

        $output = '';
        if (rex_backend_login::hasSession()) {

            if ($slice_id > 0) {
                $output .= '<div class="position-relative w-100 border border-top border-secondary-subtle mb-5">';
                $output .= '<div class="z-1 position-absolute top-0 end-0">';
                $output .= '<a class="btn btn-secondary btn-sm" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&slice_id=' . $slice_id . '&clang=' . $clang_id . '&function=edit#slice' . $slice_id . '">' . $label . '</a>';

                // Slice hinzufügen
                // https://ehkg-hn.de.test/redaxo/index.php?page=content/edit&article_id=300&clang=1&ctype=1&slice_id=770&function=add&module_id=89#slice-add-pos-2
                $module_sql = \rex_sql::factory()
                    ->getArray('SELECT id, `key` FROM ' . \rex::getTablePrefix() . 'module');
                $modulauswahl = [];
                foreach ($module_sql as $module) {
                    // config.yml Property module laden
                    $addon = rex_addon::get('plus_bs5');
                    $module_config = $addon->getProperty('module');
                    if (isset($module_config[$module['key']])) {
                        $modulauswahl[$module['id']] = $module_config[$module['key']];
                    } else {
                        $modulauswahl[$module['id']] = $module['key'];
                    }
                }
                // btn mit dropdown
                $output .= '<div class="btn-group">';
                $output .= '<button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-right" data-bs-toggle="dropdown" aria-expanded="false">';
                $output .= 'Abschnitt hinzufügen';
                $output .= '</button>';
                $output .= '<ul class="dropdown-menu dropdown-menu-end">';
                foreach ($modulauswahl as $modul_id => $modul_name) {
                    $output .= '<li><a class="dropdown-item" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&clang=' . $clang_id . '&module_id=' . $modul_id . '&slice_id=' . $slice_id . '&function=add">' . $modul_name . '</a></li>';
                }
                $output .= '</ul>';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';
            } else {
                $output .= '<a class="badge bg-secondary mx-2 p-1 badge-small" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&clang=' . $clang_id . '">' . $label . '</a>';
            }
            return $output;
        }
        return '';
    }

    public static function getBackendTableManagerEditLink(string $tablename, int $id, string $addon_page = 'yform/tablemanager', $label = 'bearbeiten'): string
    {
        if (rex_backend_login::hasSession()) {
            $url = rex_yform_manager::url($tablename, $id, ['page' => $addon_page]);
            return '<a class="btn btn-secondary" href="' . $url . '">' . $label . '</a>';
        }
        return '';
    }

    public static function getBackendMediapoolEditLink(string $filename, string $label = 'Medium bearbeiten'): string
    {
        if (rex_backend_login::hasSession()) {
            return '<a class="badge bg-primary badge-sm" href="/redaxo/index.php?page=mediapool/detail&file=' . $filename . '">' . $label . '</a>';
        }
        return '';
    }

    public static function showBackendUserInstruction(string $instruction, string $link = ''): void
    {
        if (rex_backend_login::hasSession()) {
            echo '<p><i class="fa fa-info-circle"></i> ' . $instruction . ' ' . $link . '</p>';
        }
    }
    public static function showBackendUserA18yInstruction(string $instruction, string $link = ''): void
    {
        if (rex_backend_login::hasSession()) {
            echo '<p><i class="fa fa-universal-access text-primary"></i> ' . $instruction . ' ' . $link . '</p>';
        }
    }


    public static function setIndicators(): void
    {
        $addon = rex_addon::get('plus_bs5');
        $page = $addon->getProperty('page');
        if (boolval($addon->getConfig('dev'))) {
            $page['title'] .= ' <span class="label label-info pull-right">D</span>';
            $page['icon'] = 'rex-icon fa-toggle-on';
            $addon->setProperty('page', $page);
        }

        $addon->setProperty('page', $page);
    }

    public static function getSearchitStatsKeywords(int $limit = 50)
    {
        $sql = rex_sql::factory();
        $sql->setQuery('SELECT CONCAT(UPPER(SUBSTRING(term, 1, 1)), SUBSTRING(term, 2)) AS term, SUM(resultcount) AS total_resultcount
        FROM rex_search_it_stats_searchterms
        GROUP BY term
        ORDER BY total_resultcount DESC
        LIMIT ' . $limit);
        $result = $sql->getArray();

        $options = array_column($result, 'term');
        return $options;
    }
}
