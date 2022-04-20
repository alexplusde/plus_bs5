<?php

class bs5
{
    public static function updateModule()
    {
        $modules = scandir(rex_path::addon('plus_bs5').'module');

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
        $modules = rex_sql::factory()->setDebug(0)->getArray("SELECT * FROM rex_module WHERE `key` LIKE '%bs5_%'");

        foreach ($modules as $module) {
            rex_file::put(rex_path::addon("plus_bs5", "module/".$module['key'].".json"), json_encode($module));
        }
    }

    public static function writeTemplate()
    {
        $templates = rex_sql::factory()->setDebug(0)->getArray("SELECT * FROM rex_template WHERE `key` LIKE '%bs5_%'");

        foreach ($templates as $template) {
            rex_file::put(rex_path::addon("plus_bs5", "template/".$template['key'].".json"), json_encode($template));
        }
    }
    public static function updateTemplate()
    {
        $templates = scandir(rex_path::addon('plus_bs5').'template');

        foreach ($templates as $template) {
            if ('.' == $template || '..' == $template) {
                continue;
            }
            $template_array = json_decode(rex_file::get(rex_path::addon('plus_bs5').'template/'.$template), 1);

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
}
