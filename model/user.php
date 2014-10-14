<?php

class model_user
{
    protected $user_data = array();
    private static $instance;
    protected $user_id;
    
    /**
     * Constructor
     *
     * @param int $user_id       - Specific user id. Pass FALSE to use username and password
     * @param str $username      - Ignored if $user_id is passed
     * @param str $password      - Plain text password, ignored if $user_id is passed
     * @param str $instance_name - Instance name
     * @param bol $session       - Defines if the logged in user id should be saved in session
     */
    public function __construct($username = false, $password = false)
    {
        if (($username) && ($password)) {
            $instance->login_by_username_and_password($username, $password);
        }
    }
    
    /**
     * Instance
     * Singleton function
     *
     * @return object
     */
    static function instance()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            $class            = __CLASS__;
            $new_instance     = new $class;
            $_SESSION['user'] = $new_instance;
        }
        return $_SESSION['user'];
    }
    
    /**
     * getId
     * returns the current users userID
     *
     * @return int
     */
    function getId()
    {
        return $this->user_id;
    }
    
    
    /**
     * encrypt_password
     * encrypts and returns the string
     *
     * @param string password
     * @return string
     */
    public static function encrypt_password($password)
    {
        return md5($password);
    }
    
    /**
     * Create User
     * Creates a basic user to access more of the site
     *
     * @param string fname
     * @param string lname
     * @param string username
     * @param string password
     * @return int
     */
    public static function create_user($fname, $lname, $username, $password)
    {
        return model::factory('database')->query('insert into user (fname, lname, username, password) values ("' . $fname . '", "' . $lname . '","' . $username . '","' . $password . '")');
    }
    /**
     * Delete User
     * Deletes a user and its posts permanently from the systemm
     *
     * @param int id
     */
    public static function delete_user($id)
    {
        model::factory('database')->safe_query('delete from post where author = :id', array('id' => $id));
        return model::factory('database')->safe_query('delete from user where user_id = :id', array('id' => $id));
    }
    /**
     * Login by username and password
     * Takes username and password, searches the db for a match and then calls login_by_user_id
     *
     * @param string username
     * @param string password
     * @return mixed
     */
    function login_by_username_and_password($username, $password)
    {
        $sql = 'select user_id from user where username = :username and password = :password';
	$params = array('username' => $username, 'password' => $this->encrypt_password($password));
        $id  = model::factory('database')->safe_query($sql, $params);
        if (count($id)) {
            return $this->login_by_user_id($id[0]['user_id']);
        } else {
            return false;
        }
    }
    
    /**
     * Login by user id
     * Takes userid and logs the user in
     *
     * @param int id
     * @return mixed
     */
    function login_by_user_id($id)
    {
        if ($this->get_username_by_id($id)) {
            return $this->load_user_data($id);
        } else {
            return false;
        }
    }
    
    /**
     * Load user data
     * Called when login occurs. Loads the users data into the object
     *
     * @param int id
     * @return mixed
     */
    function load_user_data($id)
    {
        $data = $this->get_user_data($id);
        if ($data) {
            $this->user_id   = $id;
            $this->user_data = $data;
            return $this;
        }
        return false;
    }
    
    /**
     * Get user data
     * Gets the userdata from the database
     *
     * @param int id
     * @return array
     */
    public static function get_user_data($id)
    {
        $data = model::factory('database')->safe_query('select * from user where user_id = :id', array('id' => $id));
        if (count($data)) {
            unset($data[0]['user_id'], $data[0]['password']);
            return $data;
        } else {
            return array();
        }
    }
    /**
     * Get currentuser data
     * Gets the userdata from the current user
     *
     * @return array
     */
    public function get_current_user_data()
    {
        return $this->user_data;
    }
    
    /**
     * Get username by id
     * returns the username corresponding to the user_id
     *
     * @param int id
     * @return mixed string username if success else false
     */
    static function get_username_by_id($id)
    {
        list($username) = model::factory('database')->safe_query('select username from user where user_id =:id', array('id' => $id));
	if(count($username) > 0){
            return $username['username'];
        } else {
            return false;
        }
    }
    
    /**
     * Logged in
     * Checks to see if the user is currently logged in.
     *
     * @return bool
     */
    function logged_in()
    {
        if (isset($this->user_id) && is_numeric($this->user_id)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * isAdmin
     * Checks whether or not the user has administrative rights
     *
     * @return bool
     */
    function isAdmin()
    {
        if ($this->logged_in()) {
            return true;
        } else
            return false;
    }
    
    /**
     * get full name
     * Returns the full name of the current user
     *
     * @return string
     */
    public function get_full_name()
    {
        return $this->user_data['fname'] . ' ' . $this->user_data['lname'];
    }
    
    /**
     * free username
     * Used in the validation process to check whether or not a username is taken
     *
     * @param string username
     * @return bool
     */
    static function free_username($username)
    {
	$free = model::factory('database')->safe_query('select username from user where username = :username', array('username' => $username));
        if (count($free) == 0)
            return true;
        else
            return false;
    }
    
    /**
     * change_user_details
     * Updates user details according to details
     *
     * @param int id the user id
     * @param array details key-value pairs of the new details
     */
    static function change_user_details($id, $details)
    {
        unset($details['user_id']);
	foreach($details as $key => $value){
	    model::factory('database')->safe_query('update user set :key = :value where user_id = :id',
			    array('key' => $key, 'value' => $value, 'id' => $id)
			);
	}
	
    }
    static function generate_password($len = 8)
    {
        $chars = 'abcdefghigjklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ1234567890';
        
        $pass = "";
        for ($i = 0; $i < $len; $i++) {
            $r = rand(0, (strlen($chars) - 1));
            $pass .= $chars[$r];
        }
        return $pass;
        
    }
    static function change_password($userid, $newpassword)
    {
	model::factory('database')->safe_query('update user set password=:password where user_id = :user_id',
				    array('password' => $newpassword, 'user_id' => $userid));
    }
    static function check_password($userid, $password)
    {
	$count = model::factory('database')->safe_query('select user_id from user where user_id = :user_id and where password = :password',
					    array('user_id' => $userid, 'password' => $password));
        if (count($count) == 1) {
            return true;
        } else {
            return false;
        }
    }
}




?>