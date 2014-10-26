<?php

class model_debug {
    static function shutdown(){
        var_dump(func_get_args());
        var_dump(__LINE__, __FILE__);
        var_dump(debug_backtrace());
    }
    static function errorhandler(){
        var_dump(func_get_args());
        var_dump(__LINE__, __FILE__);
        var_dump(debug_backtrace());
    }
}