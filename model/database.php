<?php
class model_database {
    private static $instance;
    private $connection;
    public $queries = array();

    function model_database(){
        $this->connection = mysqli_connect('localhost', 'draco', '#Warcraft1', 'd0019e_blogg');
    }

    static function instance(){
        if(is_null(self::$instance))
            self::$instance = new model_database();

        return self::$instance;
    }
    function query($sql){
        $this->queries[] = $sql;
        return $this->connection->query($sql);
    }
    function get_connection(){
        return $this->connection;
    }
    function get_queries(){
        return $this->queries;
    }
    function escape($string){
        return $this->connection->real_escape_string($string);
    }

}