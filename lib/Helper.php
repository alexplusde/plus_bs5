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
use rex_i18n;
use rex_path;
use rex_sql;
use rex_string;
use rex_view;
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

    public static function updateModule($addon = 'plus_bs5')
    {
        $modules = preg_grep('~\.(json)$~', scandir(rex_path::addon(".new.".$addon) . 'install/module'));

        foreach ($modules as $module) {
            // Anstelle von .json ist die Endung .php für die Template-Datei
            $module_array = json_decode(rex_file::get(rex_path::addon(".new.".$addon) . 'install/module/' . $module), 1);
            $module_array['input'] = rex_file::get(rex_path::addon(".new.".$addon) . 'install/module/' . str_replace('.json', '.input.php', $module));
            $module_array['output'] = rex_file::get(rex_path::addon(".new.".$addon) . 'install/module/' . str_replace('.json', '.output.php', $module));

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

    public static function writeModule($addon = 'plus_bs5', $query = 'bs5.%')
    {
        $modules = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_module WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($modules as $module) {
            rex_file::put(rex_path::addon($addon, 'install/module/' . rex_string::normalize($module['key']) . '.input.php'), $module['input']);
            rex_file::put(rex_path::addon($addon, 'install/module/' . rex_string::normalize($module['key']) . '.output.php'), $module['output']);
            unset($module['input']);
            unset($module['output']);
            rex_file::put(rex_path::addon($addon, 'install/module/' . rex_string::normalize($module['key']) . '.json'), json_encode($module));
        }
    }

    public static function updateTemplate($addon = 'plus_bs5')
    {
        $templates = preg_grep('~\.(json)$~', scandir(rex_path::addon(".new.".$addon) . 'install/template'));

        foreach ($templates as $template) {
            $template_array = json_decode(rex_file::get(rex_path::addon(".new.".$addon) . 'install/template/' . $template), 1);
            // Anstelle von .json ist die Endung .php für die Template-Datei
            $template_array['content'] = rex_file::get(rex_path::addon(".new.".$addon) . 'install/template/' . str_replace('.json', '.php', $template));
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

    public static function writeTemplate($addon = 'plus_bs5', $query = 'bs5.%')
    {
        $templates = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_template WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($templates as $template) {
            rex_file::put(rex_path::addon($addon, 'install/template/' . rex_string::normalize($template['key']) . '.php'), $template['content']);
            unset($template['content']);
            rex_file::put(rex_path::addon($addon, 'install/template/' . rex_string::normalize($template['key']) . '.json'), json_encode($template));
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
            return '<a class="badge badge-primary" href="/redaxo/index.php?page=' . $page . '">wechseln</a>';
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

        if (rex_backend_login::hasSession()) {
            if (!($slice_id > 0)) {
                return '<a class="badge bg-secondary mx-3 p-1 badge-small" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&clang=' . $clang_id . '">' . $label . '</a>';
            }
            return '<a class="badge bg-secondary mx-3 p-1 badge-small" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&slice_id=' . $slice_id . '&clang=' . $clang_id . '&function=edit#slice' . $slice_id . '">' . $label . '</a>';
        }
        return '';
    }

    public static function getBackendTableManagerEditLink(string $tablename, int $id, string $addon_page = 'yform/tablemanager', $label = 'bearbeiten'): string
    {
        if (rex_backend_login::hasSession()) {
            $url = rex_yform_manager::url($tablename, $id, ['page' => $addon_page]);
            return '<a class="badge badge-primary" href="' . $url . '">' . $label . '</a>';
        }
        return '';
    }

    public static function getBackendMediapoolEditLink(string $filename, string $label = 'Medium bearbeiten'): string
    {
        if (rex_backend_login::hasSession()) {
            return '<a class="badge badge-primary badge-sm" href="/redaxo/index.php?page=mediapool/detail&file=' . $filename . '">' . $label . '</a>';
        }
        return '';
    }

    public static function showBackendUserInstruction(string $instruction, string $link = ''): void
    {
        echo '<p><i class="fa fa-info-circle"></i> ' . $instruction . ' ' . $link . '</p>';
    }
    public static function showBackendUserA18yInstruction(string $instruction, string $link = ''): void
    {
        echo '<p><i class="fa fa-universal-access text-primary"></i> ' . $instruction . ' ' . $link . '</p>';
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
}
