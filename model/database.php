<?php
class model_database {
    private static $instance;
    private $connection;
    public $queries = array();

    function model_database(){
        global $conf;
        $this->database = new PDO($conf['database']['dsn'], $conf['database']['username'], $conf['database']['password'], $conf['database']['driver_options']);
    }
    static function instance(){
        if(is_null(self::$instance))
            self::$instance = new model_database();

        return self::$instance;
    }
    static function escape_string($string){
        return self::instance()->connection->real_escape_string($string);
    }
    function query($sql){
        $statement = $this->database->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }
    function insert($sql, $parameters=array()){
        if(!is_array($parameters))
            $parameters = array($parameters);
        
        $statement = $this->database->prepare($sql);
        $statement->execute($parameters);
        return $this->database->lastInsertId();

    }
    function safe_query($sql, $parameters=array()){
        if(!is_array($parameters))
            $parameters = array($parameters);
        
        $statement = $this->database->prepare($sql);
        $statement->execute($parameters);
        return $statement->fetchAll();
    }
    function get_connection(){
        return $this->connection;
    }
    function get_queries(){
        return $this->queries;
    }/* */
    function escape($string){
        return $this->connection->real_escape_string($string);
    }
/* */
}