<?php
class model_conf{
    static function set($thing, $value){
        $sql = 'select `key` from conf where `key` = "'.$thing.'"';
        $exist = model::factory('database')->query($sql);
        if($exist->num_rows > 0){
            model::factory('database')->query('update conf set value = "'.$value.'" where `key` = "'.$thing.'"');
        } else {
            model::factory('database')->query('insert into conf (`key`, value) values ("'.$thing.'", "'.$value.'")');
        }
    }
    static function get($thing){
        $get = model::factory('database')->query('select * from conf where `key` = "'.$thing.'"');
        if(!empty($get)){
            return array_pop($get);
        } else {
            return false;
        }
    }
    static function get_value($thing){
        $arr = self::get($thing);
        return $arr['value'];
    }

    function get_all(){
        $settings = array();
        $r = model::factory('database')->query('select * from conf order by name asc');
        foreach($r as $s){
            $settings[] = $s;
        }
        return $settings;
    }
}