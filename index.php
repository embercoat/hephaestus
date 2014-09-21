<?php
define('key', '');
require('init.php');
session_start();

$renderer = new model_renderer();
$parts = model::factory('url')->get_parts();

switch($parts[0]){
    case 'admin':{
        if(model_user::instance()->isAdmin()){
    		$parts = resolv($_GET);
    		$class = new $parts['class']();
    		if(method_exists($class, 'before')){
    		    $class->before();
    		}
        	call_user_func_array(array($class,$parts['method']), $parts['params']);
            echo model::factory('renderer')->render('template/admin/main.html');
            break;
        }
    }
    case 'login':{
		$parts = resolv($_GET);
		$parts['method'] = (($parts['method']=='index')?'login':$parts['method']);
		$login_class = new controller_login();
    	call_user_func_array(array($login_class, $parts['method']), $parts['params']);
        echo model::factory('renderer')->render('template/login.html');
    break;
    }
    default:{
		$parts = resolv($_GET);
		$class = new $parts['class']();
		if(method_exists($class, 'before')){
	        $class->before();
	    }
		
	    call_user_func_array(array($class,$parts['method']), $parts['params']);
        echo model::factory('renderer')->render('template/main.html');
    }
}
?>