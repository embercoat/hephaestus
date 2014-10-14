<?php
class model_conf{
    static function set($thing, $value){
        $sql = 'select `key` from conf where `key` = "'.$thing.'"';
        $exist = model::factory('database')->query($sql);
        /*DB::select('key')
                    ->from('store')
                    ->where('key', '=', $thing)
                    ->execute()
                    ->as_array();*/
        if($exist->num_rows > 0){
            model::factory('database')->query('update conf set value = "'.$value.'" where `key` = "'.$thing.'"');
            /*DB::update('store')
                ->set(array('value' =>$value))
                ->where('key', '=', $thing)
                ->execute();*/
        } else {
            model::factory('database')->query('insert into conf (`key`, value) values ("'.$thing.'", "'.$value.'")');
            /*DB::insert('store', array('key', 'value'))
                ->values(array($thing, $value))
                ->execute();*/
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
        while($s = $r->fetch_assoc())
            $settings[] = $s;
        return $settings;
        //while($)
        //return DB::select('*')->from('store')->order_by('name', 'ASC')->execute()->as_array();
    }
}