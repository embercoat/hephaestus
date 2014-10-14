<?php

class model_session {
    private $data = array();
    private static $instance;
    
    static function instance(){
        if(!isset(self::$instance)){
            $model_name = __CLASS__;
            self::$instance = new $model_name;
        }
        return self::$instance;
    }
    
    function __construct(){
        if(isset($_SESSION['data']))
            $this->data = $_SESSION['data'];
        if(!isset($_SESSION['persistent']))
            $_SESSION['persistent'] = array();
    }
    function __destruct(){
        $_SESSION['data'] = $this->data;
    }
    
    function set($key, $data){
        $_SESSION['persistent'][$key] = $data;
    }
    function get($key){
        if(isset($_SESSION['persistent'][$key]))
            return $_SESSION['persistent'][$key];
        else
            return false;
    }
    function get_list(){
        return array_keys($_SESSION['persistent']);
    }
}
