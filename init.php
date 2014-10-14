<?php
if(!defined('key')) header('location: /');

include('conf.php');
global $conf;

define('BASEPATH', $conf['basepath']);
define('UPLOAD', BASEPATH.$conf['upload']);
if(!is_dir(UPLOAD)) mkdir(UPLOAD);


function __autoload($class){
    global $conf;
    $class = str_replace('_', '/', $class);
    $path = BASEPATH.$class.'.php';
    if(is_file($path)){
        include_once($path);
    }
}

function resolv($url){
	$parts = model::factory('url')->get_parts();
	if($parts[0] == 'admin'){
		$parts = model::factory('url')->get_parts();
		if(!isset($parts[1]) || $parts[1] == '')
			$parts[1] = 'welcome';
		if(isset($parts[3]))
			$params = explode('/', $parts[3]);
		else
			$params = array();
		$class_name = 'controller_'.$parts[0].'_'.$parts[1];
		$class = new $class_name;
		$method = (isset($parts[2]) && !empty($parts[2])) ? $parts[2] : 'index';
	} else {
		$parts = model::factory('url')->get_parts();
		if($parts[0] == '')
			$parts[0] = 'welcome';
		if(isset($parts[2]))
			$params = explode('/', $parts[2]);
		else
			$params = array();
		$class_name = 'controller_'.$parts[0];
		$class = new $class_name;
		$method = (isset($parts[1]) && !empty($parts[1])) ? $parts[1] : 'index';
	}
	return array(
		'class' => $class,
		'params' => $params,
		'method' => $method
	);
}

model_user::instance();


?>