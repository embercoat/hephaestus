<?php
class model_message {
    private $messages = array();

    function __destruct(){
        $_SESSION['messages'] = $this->messages;
    }
    function __construct(){
        if(isset($_SESSION['messages']))
            $this->messages = $_SESSION['messages'];
    }

    function add($message, $class = 'info'){
        $this->messages[$class][] = $message;
    }
    function get($class = false){
        if($class){
            if(isset($this->messages[$class]))
                return $this->messsages[$class];
            else
                return false;
        } else {
            return $this->messages;
        }
    }
    function clear($class = false){
        if($class)
            unset($this->messages[$class]);
        else
            $this->messages = array();
    }
}