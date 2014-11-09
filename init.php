<?php
// Hacker! Stop that!
if(!defined('key')) header('location: /');

// Require the all-important configurations
require_once('conf.php');
global $conf;

// A few definitions to start us off
define('BASEPATH', $conf['basepath']);
define('UPLOAD', BASEPATH.$conf['upload']);
define('BASEURL', $conf['baseurl']);
// Create the upload-dir if it doesnt exist.
if(!is_dir(UPLOAD)) mkdir(UPLOAD);

// Overload the autoloader to make it do stuff more suited to this platform
function __autoload($class){
    global $conf;
	// Replace _ with / to allow for a tree_structure
    $class = str_replace('_', '/', $class);
	// Prepend basepath
    $path = BASEPATH.$class.'.php';
    if(is_file($path)){
		// include the class_file if it exists
        include_once($path);
    }
}
$log = model::factory('log');
$log->set_loglevel($log::INFORMATION);
// The magic bit
function resolv($url){
	// get_parts splits the url by '/' and returns an array with the parts or a single element array with ''
	$parts = model::factory('url')->get_parts();
	if($parts[0] == 'admin'){
		// Admin... Always requiring special attention...
		// Set the controller to be used if none is set
		if(!isset($parts[1]) || $parts[1] == '')
			$parts[1] = 'welcome';
		// Prepare the parameters
		if(isset($parts[3]))
			$params = explode('/', $parts[3]);
		else
			$params = array();
		
		// Instantiate the class
		$class_name = 'controller_'.$parts[0].'_'.$parts[1];
		$class = new $class_name;
		// And finish with the method
		$method = (isset($parts[2]) && !empty($parts[2])) ? $parts[2] : 'index';
	} else {
		// if parts is empty, use the default welcome-controller
		if($parts[0] == '')
			$parts[0] = 'welcome';
		
		// Prepare the parameters
		if(isset($parts[2]))
			$params = explode('/', $parts[2]);
		else
			$params = array();
		
		// Instantiate the class
		$class_name = 'controller_'.$parts[0];
		$class = new $class_name;
		// And finish with the method
		$method = (isset($parts[1]) && !empty($parts[1])) ? $parts[1] : 'index';
	}
	// Once done. return an array with the stuff
	return array(
		'class' => $class,
		'params' => $params,
		'method' => $method
	);
}

model_user::instance();


?>