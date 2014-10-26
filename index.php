<?php
// Anti-hacking bit. Requires the constant key to be set for subsequent inclusions to not self-destruct. And forcing stuff to go through index.php
if(!defined('key'))
	define('key', '');

// Include init.php if not already included earlier.
require_once('init.php');

// Change the session-timeout to something from the database.
ini_set("session.cookie_lifetime",$conf['session_timeout']);
// and start it
session_start();

// Initialize a new global rendering object accessible from model::factory('renderer')
$renderer = new model_renderer();

// Do some magic with the url
$parts = model::factory('url')->get_parts();
switch($parts[0]){
    case 'admin':{
		// Admin? are you sure you are admin?
        if(model_user::instance()->isAdmin()){
			// Seems like it.
			$parts = resolv($_GET);
			// Which controller do you want? Ah yes! That one.
			$class = new $parts['class']();
			// Run the before part if there is one.
			if(method_exists($class, 'before')){
				$class->before();
			}
			// Alright, enough foreplay. Call the class already and its method. And don't forget the parameters!
			call_user_func_array(array($class,$parts['method']), $parts['params']);
			// Echo back the results.
			echo model::factory('renderer')->render('template/admin/main.html');
			break;
        }
    }
    case 'login':{
		// Login then
		// Split the url by a bit of magic
		$parts = resolv($_GET);
		// Change the requested method if needed
		$parts['method'] = (($parts['method']=='index')?'login':$parts['method']);
		// Instantiate the controller
		$login_class = new controller_login();
		// Call the controller and method
    	call_user_func_array(array($login_class, $parts['method']), $parts['params']);
		// Echo back any results
        echo model::factory('renderer')->render('template/login.html');
	    break;
    }
    default:{
		// Default? Boring! anyways...
		// resolve the parts
		$parts = resolv($_GET);
		// start the class
		$class = new $parts['class']();
		// do the thing
		if(method_exists($class, 'before')){
			$class->before();
		}
		// twist it
		call_user_func_array(array($class,$parts['method']), $parts['params']);
		// do the other thing
		if(method_exists($class, 'after')){
			$class->after();
		}
		// Shoutout to my homeboys!
		echo model::factory('renderer')->render('template/main.html');
    }
}
?>