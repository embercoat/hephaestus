<?php
class controller_login {
	function index() {
        $this->login();
        var_dump($_SESSION);
    }
	function login(){
        model::factory('renderer')->title = 'Logga in - '. model::factory('conf')->get_value('site_name');
        model::factory('renderer')->logged_in = model_user::instance()->logged_in() ? 'inloggad' : 'INTE inloggad';

		if(isset($_POST) && !empty($_POST)){
		    $user = model_user::instance();
            $user->login_by_username_and_password($_POST['username'], $_POST['password']);
            
			if($user->logged_in()){
			    header('location: '.model::factory('renderer')->url('/admin'));
			}
			else{
			    header('location: '.$_SERVER['HTTP_REFERER']);
			}

		}
	}
	function logout(){
	    unset($_SESSION['user']);
	    header('Location: '.model::factory('renderer')->url('/'));
	}
}