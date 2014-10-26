<?php
/*
 * Debugger
 * This is still just a stub and will be extended in the future
 */
if(!defined('key'))
    define('key', '');
    
require_once('init.php');

register_shutdown_function(array(model::factory('debug'), 'shutdown'));
?>