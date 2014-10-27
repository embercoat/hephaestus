<?php

class model_log {
    private $logfile = '';
    function init(){
        $this->logfile = BASEPATH.'log.txt';
        if(!is_file(UPLOAD)){
            touch($this->logfile);
        }

    }
    
    function information($message){
        $this->log('INFORMATION', $message);
    }
    function warning($message){
        $this->log('WARNING', $message);
    }
    function backtrace(){
        debug_print_backtrace();
    }
    function log($type, $message){
        $msg = $type.": ".$message."\r\n";
        if(is_file($this->logfile))
            file_put_contents($this->logfile, $msg, FILE_APPEND);
        else 
            echo "DEBUG ".$type.": ".$message."\r\n";
    }
}