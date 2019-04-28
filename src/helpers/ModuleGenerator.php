<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/25/2019
 * Time: 8:14 AM
 */

namespace crocodicstudio\crudbooster\helpers;


use Illuminate\Support\Facades\DB;

class ModuleGenerator
{
    private $table;
    private $icon;
    private $name;

    public function __construct($table, $name = null, $icon = "fa fa-bars")
    {
        $this->table = $table;
        $this->icon = $icon;
        $this->name = $name;
    }

    private function makeControllerName($table) {
        $controllerName = ucwords(str_replace('_', ' ', $table));
        $controllerName = str_replace(' ', '', $controllerName).'Controller';

        $path = app_path("Http/Controllers/");
        $countSameFile = count(glob($path.'Admin'.$controllerName.'.php'));
        if ($countSameFile != 0) {
            $suffix = $countSameFile;
            $controllerName = ucwords(str_replace(['_', '-'], ' ', $controllerName)).$suffix;
            $controllerName = str_replace(' ', '', $controllerName).'Controller';
        }

        return $controllerName;
    }

    public function make() {
        $template = file_get_contents(__DIR__."/../templates/FooBarController.stub");

        //Replace table
        $template = str_replace("{table}",'"'.$this->table.'"', $template);

        //Replace permalink
        $template = str_replace("{permalink}", '"'.$this->table.'"', $template);

        //Replace scaffolding
        $fields = DB::getSchemaBuilder()->getColumnListing();
        $scaffold = "";
        foreach($fields as $field) {
            $scaffold .= '$this->addText("'.$field.'");'."\n";
        }
        $template = str_replace("{scaffolding}", $scaffold, $template);

        $filename = $this->makeControllerName($this->table);

        file_put_contents(app_path("Http/Controllers/".$filename.".php"), $template);

        //Save to database
        $module = [];
        $module['name'] = ($this->name)?:ucwords(str_replace("_"," ",$this->table));
        $module['icon'] = $this->icon;
        $module['table_name'] = $this->table;
        $module['controller'] = $filename;
        $id_modules = DB::table('cb_modules')->insertGetId($module);

        //Save menu
        $menu = [];
        $menu['name'] = $module['name'];
        $menu['type'] = 'module';
        $menu['cb_modules_id'] = $id_modules;
        DB::table('cb_menus')->insertGetId($menu);

        return $module;
    }

}