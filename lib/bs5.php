<?php

class bs5
{
    public static function packageExists(...$packages) :bool
    {
        $continue = true;
        $packages = explode(", ", array_pop($packages));
        foreach ($packages as $package) {
            if ($package !== "" && rex_addon::get($package) !== null && rex_addon::get($package)->isAvailable() !== true) {
                $continue = false;
                echo rex_view::error(rex_i18n::rawMsg('bs5_missing_addon', $package));
            }
        }
        return $continue;
    }
    public static function updateModule()
    {
        $modules = preg_grep('~\.(json)$~', scandir(rex_path::addon('plus_bs5').'module'));

        foreach ($modules as $module) {
            if ('.' == $module || '..' == $module) {
                continue;
            }
            $module_array = json_decode(rex_file::get(rex_path::addon('plus_bs5').'module/'.$module), 1);

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
    public static function writeModule()
    {
        $modules = rex_sql::factory()->setDebug(0)->getArray("SELECT * FROM rex_module WHERE `key` LIKE 'bs5/%'");

        foreach ($modules as $module) {
            rex_file::put(rex_path::addon("plus_bs5", "module/".rex_string::normalize($module['key']).".json"), json_encode($module));
            rex_file::put(rex_path::addon("plus_bs5", "module/".rex_string::normalize($module['key']).".input.php"), $module['input']);
            rex_file::put(rex_path::addon("plus_bs5", "module/".rex_string::normalize($module['key']).".output.php"), $module['output']);
        }
    }

    public static function writeTemplate()
    {
        $templates = rex_sql::factory()->setDebug(0)->getArray("SELECT * FROM rex_template WHERE `key` LIKE 'bs5/%'");

        foreach ($templates as $template) {
            rex_file::put(rex_path::addon("plus_bs5", "template/".rex_string::normalize($template['key']).".json"), json_encode($template));
            rex_file::put(rex_path::addon("plus_bs5", "template/".rex_string::normalize($template['key']).".php"), $template['content']);
        }
    }
    public static function updateTemplate()
    {
        $templates = preg_grep('~\.(json)$~', scandir(rex_path::addon('plus_bs5').'template'));

        foreach ($templates as $template) {
            if ('.' == $template || '..' == $template) {
                continue;
            }
            $template_array = json_decode(rex_file::get(rex_path::addon('plus_bs5').'template/'.$template), 1);

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
    public static function getConfig(string $key)
    {
        return rex_config::get('plus_bs5', $key);
    }
    public static function getConfigText(string $key) :string
    {
        $text = bs5::getConfig($key);
        if (rex_addon::get('sprog')->isAvailable() && !rex::isSafeMode()) {
            if ($key != sprogdown($key)) {
                $text = sprogdown($key);
            }
        }
        if ($text === null) {
            return "missing text for key <code>". $key . "</code>";
        }

        return $text;
    }

    public static function setConfig($key, $value)
    {
        rex_config::set('plus_bs5', $key, $value);
    }
}
