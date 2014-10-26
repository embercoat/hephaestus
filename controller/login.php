<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 * Login controller. Handles the login/logout procedures for the entire site.
 *
 */
class controller_login {
	/*
	 * index is just an alias for login.
	 */
	function index() {
        $this->login();
    }
	/*
	 * Login manages, well.. The login...
	 */
	function login(){
		// Check to see if there are any login-attempts
		if(isset($_POST) && !empty($_POST)){
			// If there is, initialize a user-model and check username and password against the database.
		    $user = model_user::instance();
            $user->login_by_username_and_password($_POST['username'], $_POST['password']);
            
			//Are we logged in?
			if($user->logged_in()){
				// Yes! Ship the user to adminpanel!
			    header('location: '.model::factory('renderer')->url('/admin'));
			} else {
				// Ha! You wish. Back to where you came from!
				header('location: '.$_SERVER['HTTP_REFERER']);
			}
		}
		// If no login attempt do some cosmetic stuff.
		// Set page title using pagename from database.
        model::factory('renderer')->title = 'Logga in - '. model::factory('conf')->get_value('site_name');
		// Also provide a short text to tell whether or not the user is logged in or not.
        model::factory('renderer')->logged_in = model_user::instance()->logged_in() ? 'inloggad' : 'INTE inloggad';
	}
	/*
	 * And logout of course manages the logout procedure.
	 */
	function logout(){
		// Unset the session!
	    unset($_SESSION['user']);
		// And send the user to the frontpage
	    header('Location: '.model::factory('renderer')->url('/'));
	}
}