<?php
class controller_dev extends controller_common {
    function test(){
        $database = model::factory('database');
        $r = $database->safe_query('select * from user where user_id in :user_id',
                        array('user_id' => array(329, 339)));
        
        var_Dump($r);
        var_dump($r->fetchAll());
    }
    
}