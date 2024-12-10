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
    public static function packageExists(...$packages): bool
    {
        $continue = true;
        $packages = explode(', ', array_pop($packages));
        foreach ($packages as $package) {
            if ('' !== $package && null !== rex_addon::get($package) && true !== rex_addon::get($package)->isAvailable()) {
                $continue = false;
                echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', $package));
            }
        }
        return $continue;
    }

    public static function updateModule($addon = 'plus_bs5')
    {
        $modules = preg_grep('~\.(json)$~', scandir(rex_path::addon($addon) . 'module'));

        foreach ($modules as $module) {
            $module_array = json_decode(rex_file::get(rex_path::addon($addon) . 'module/' . $module), 1);

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

    public static function writeModule($addon = 'plus_bs5', $query = 'bs5/%')
    {
        $modules = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_module WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($modules as $module) {
            rex_file::put(rex_path::addon($addon, 'module/' . rex_string::normalize($module['key']) . '.json'), json_encode($module));
            rex_file::put(rex_path::addon($addon, 'module/' . rex_string::normalize($module['key']) . '.input.php'), $module['input']);
            rex_file::put(rex_path::addon($addon, 'module/' . rex_string::normalize($module['key']) . '.output.php'), $module['output']);
        }
    }

    public static function updateTemplate($addon = 'plus_bs5')
    {
        $templates = preg_grep('~\.(json)$~', scandir(rex_path::addon($addon) . 'template'));

        foreach ($templates as $template) {
            $template_array = json_decode(rex_file::get(rex_path::addon($addon) . 'template/' . $template), 1);

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

    public static function writeTemplate($addon = 'plus_bs5', $query = 'bs5/%')
    {
        $templates = rex_sql::factory()->setDebug(0)->getArray('SELECT * FROM rex_template WHERE `key` LIKE :query', ['query' => $query]);

        foreach ($templates as $template) {
            rex_file::put(rex_path::addon($addon, 'template/' . rex_string::normalize($template['key']) . '.json'), json_encode($template));
            rex_file::put(rex_path::addon($addon, 'template/' . rex_string::normalize($template['key']) . '.php'), $template['content']);
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

    public static function getBackendEditLink(?int $article_id = null, ?int $clang_id = null, ?int $slice_id = null): string
    {
        if (null === $article_id) {
            $article_id = rex_article::getCurrentId();
        }
        if (null === $clang_id) {
            $clang_id = rex_clang::getCurrentId();
        }

        if (rex_backend_login::hasSession()) {
            if (!($slice_id > 0)) {
                return '<a class="badge bg-secondary mx-3 p-1 badge-small" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&clang=' . $clang_id . '">bearbeiten</a>';
            }
            return '<a class="badge bg-secondary mx-3 p-1 badge-small" href="/redaxo/index.php?page=content/edit&article_id=' . $article_id . '&slice_id=' . $slice_id . '&clang=' . $clang_id . '&function=edit#slice' . $slice_id . '">bearbeiten</a>';
        }
        return '';
    }

    public static function getBackendTableManagerEditLink(string $tablename, int $id, string $addon_page = 'yform/tablemanager'): string
    {
        if (rex_backend_login::hasSession()) {
            $url = rex_yform_manager::url($tablename, $id, ['page' => $addon_page]);
            return '<a class="badge badge-primary" href="' . $url . '">bearbeiten</a>';
        }
        return '';
    }
}