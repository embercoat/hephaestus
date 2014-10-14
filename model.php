<?php
class model{
    private static $instances = array();
    static function &factory($model, $instance = 'default'){
        if(!isset(self::$instances[$model][$instance])){
            $model_name = 'model_'.$model;
            self::$instances[$model][$instance] = new $model_name;
        }
        return self::$instances[$model][$instance];
    }
    static function list_instances(){
        var_dump(self::$instances);
    }
}