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
    
    public static function updateTemplate()
    {
        $templates = scandir(rex_path::addon('plus_bs5').'template');

        foreach ($templates as $template) {
            if ('.' == $template || '..' == $template) {
                continue;
            }
            $template_array = json_decode(rex_file::get(rex_path::addon('plus_bs5').'template/'.$template), 1);

            rex_sql::factory()->setDebug(0)->setTable('rex_module')
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
}

bs5::updateModule();
bs5::updateTemplate();
