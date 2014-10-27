<?php

class model_debug {
    
    static function shutdown(){
        if(model_user::instance()->logged_in()){
            var_dump(func_get_args());
            var_dump(__LINE__, __FILE__);
            var_dump(debug_backtrace());
        }
    }
    static function errorhandler(){
        if(model_user::instance()->logged_in()){
            var_dump(func_get_args());
            var_dump(__LINE__, __FILE__);
            var_dump(debug_backtrace());
        }
    }
    static function print_backtrace($backtrace = false){
        if(!$backtrace){
            $backtrace = debug_backtrace();
        }
        foreach($backtrace as $b){
            var_dump($b);
            
        }
    }
}