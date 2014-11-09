<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 * 
 * This is the model-model. It creates and keeps track of all instances of all models currently in use.
 */
class model{
    // Instances collection
    private static $instances = array();
    
    /*
     * Factory function
     * Checks to see whether or not a new instance needs to be created or reuse an old one.
     *
     * @param string $model Name of the model to be used.
     * @param string $instance Select the instance to be used. Defaults to 'default'
     * @return object returns the object selected
     */
    static function &factory($model, $instance = 'default'){
        // Do we have an old intance available?
        if(!isset(self::$instances[$model][$instance])){
            // No? Well make on up then!
            $model_name = 'model_'.$model;
            self::$instances[$model][$instance] = new $model_name;
            if(method_exists(self::$instances[$model][$instance], 'init'))
                self::$instances[$model][$instance]->init();
        }
        // Return it
        return self::$instances[$model][$instance];
    }
    static function __callStatic($name, $args){
        if(isset($args[0])){
            return self::factory($name, $args[0]);
        } else {
            return self::factory($name);
        }
    }
    /*
     * list instances
     * Debugging-tool. Dumps all known instances
     */
    static function list_instances(){
        var_dump(self::$instances);
    }
}