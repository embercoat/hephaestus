<?php
class model_log {
    const DEBUG = 1;
    const INFORMATION = 2;
    const WARNING = 3;
    const CRITICAL = 4;
    
    private $level_title = array(
        1 => 'DEBUG',
        2 => 'INFORMATION',
        3 => 'WARNING',
        4 => 'CRITICAL'
    );
    private $loglevel;
    
    private $logfile = 4;
    function init(){
        $this->logfile = BASEPATH.'log.txt';
        if(!is_file($this->logfile)){
            touch($this->logfile);
        }

    }
    function set_loglevel($level){
        $this->loglevel = $level;
    }
    function debug($message){
        $this->log($this::DEBUG, $message);
    }
    function information($message){
        $this->log($this::INFORMATION, $message);
    }
    function warning($message){
        $this->log($this::WARNING, $message);
    }
    function critical($message){
        $this->log($this::CRITICAL, $message);
    }
    function backtrace(){
        debug_print_backtrace();
    }
    function log($level, $message){
        if($level >= $this->loglevel){
            $msg = $this->level_title[$level].": ".$message."\r\n";
            if(is_file($this->logfile))
                file_put_contents($this->logfile, $msg, FILE_APPEND);
            else 
                echo $msg;
        }
    }
}