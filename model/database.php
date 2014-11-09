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
        $statement->setFetchMode(PDO::FETCH_ASSOC);
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
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute($parameters);
        if($statement->errorCode() != '00000'){
            model::debug()->print_backtrace();
            model::factory('log')->warning('PDO errorcode: '.$statement->errorCode());
            model::factory('log')->warning('PDO errorinfo: '.json_encode($statement->errorInfo()));
            model::factory('log')->warning('PDO sql: '. $sql);
            model::factory('log')->warning('PDO parameters: '. json_encode($parameters));
        }
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