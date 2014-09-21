<?php
class class_login {
	function index() {
	}
	function login(){
        model::factory('renderer')->title = 'Logga in - '. model::factory('conf')->get_value('site_name');

		if(isset($_POST) && !empty($_POST)){
		    $user = model_user::instance();
			$user->login_by_username_and_password($_POST['username'], $_POST['password']);
			var_dump($user);
			if($user->logged_in()){
			    header('location: /admin');
			}
			else{
			    header('location: '.$_SERVER['HTTP_REFERER']);
			}

		}
	}
	function logout(){
	    unset($_SESSION['user']);
	    header('Location: /');
	}
}