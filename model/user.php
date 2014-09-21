<?php

class model_user{
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
		if (($username) && ($password))
		{
			$instance->login_by_username_and_password($username, $password);
		}
	}

    /**
	 * Instance
	 * Singleton function
	 *
	 * @return object
	 */
    static function instance(){
		if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
			$class = __CLASS__;
			$new_instance = new $class;
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
    function getId(){
        return $this->user_id;
    }


    /**
	 * encrypt_password
	 * encrypts and returns the string
	 *
	 * @param string password
	 * @return string
	 */
    public static function encrypt_password($password){
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
    public static function create_user($fname, $lname, $username, $password){
        return model::factory('database')->query('insert into user (fname, lname, username, password) values ("'.$fname.'", "'.$lname.'","'.$username.'","'.$password.'")');
    }
    /**
     * Delete User
     * Deletes a user and its posts permanently from the systemm
     *
     * @param int id
     */
    public static function delete_user($id){
        model::factory('database')->query('delete from post where author = "'.$id.'"');
        return model::factory('database')->query('delete from user where user_id = "'.$id.'"');

    }
    /**
	 * Login by username and password
	 * Takes username and password, searches the db for a match and then calls login_by_user_id
	 *
	 * @param string username
	 * @param string password
	 * @return mixed
	 */
    function login_by_username_and_password($username, $password){
    	$sql = 'select user_id from user where username = "'.$username.'" and password = "'.$this->encrypt_password($password).'"';
        $id =  model::factory('database')
        	->query($sql);
        if($id = $id->fetch_assoc()){
            return $this->login_by_user_id($id['user_id']);
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
    function login_by_user_id($id){
        if($this->get_username_by_id($id)){
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
    function load_user_data($id){
        $data = $this->get_user_data($id);
        if($data){
            $this->user_id = $id;
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
    public static function get_user_data($id){
        $data = model::factory('database')->query('select * from user where user_id = "'.$id.'"');
        if($data = $data->fetch_assoc()){
            unset($data['user_id'], $data['password']);
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
    public function get_current_user_data(){
        return $this->user_data;
    }

    /**
	 * getMembertype
	 * Returns single membertype if presented with type_id, if not, returns all membertypes
	 *
	 * @param type_id
	 * @return array
	 */
    public static function get_membertype($type_id = false){
        /*$data = DB::select('*')
                    ->from(array('membertype', 'mt'))
                    ->order_by('sortorder', 'asc');*/
        $data = model::factory('database')->query('select * from usertype as mt order by sortorder asc');
        if($type_id !== false){
            $data = $data->where('id', '=', $type_id);
        }
        return $data->execute()->as_array();
    }


    /**
	 * Get username by id
	 * returns the username corresponding to the user_id
	 *
	 * @param int id
	 * @return mixed string username if success else false
	 */
    static function get_username_by_id($id){
        //$username = DB::select('username')->from('user')->where('user_id','=',$id)->execute()->as_array();
        $username = model::factory('database')->query('select username from user where user_id ="'.$id.'"');
        //if(count($username) > 0){
        if($data = $username->fetch_assoc()){
        	return $data['username'];
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
    function logged_in(){
        if(isset($this->user_id) && is_numeric($this->user_id)){
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
    function isAdmin(){
        if($this->logged_in()) {
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
    public function get_full_name(){
        return $this->user_data['fname'].' '.$this->user_data['lname'];
    }

    /**
	 * free username
	 * Used in the validation process to check whether or not a username is taken
	 *
	 * @param string username
	 * @return bool
	 */
    static function free_username($username){
        $free = DB::select('username')->from('user')->where('username','=',$username)->execute()->as_array();
        if(count($free) == 0)
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
    static function change_user_details($id, $details){
        unset($details['user_id']);
        $q = DB::update('user')
	            ->set($details)
	            ->where('user_id','=', $id)
	            ->execute();
    }
    static function generate_password($len = 8){
        $chars = 'abcdefghigjklmnopqrstuvxyzABCDEFGHIJKLMNOPQRSTUVXYZ1234567890';

        $pass = "";
        for($i =0; $i<$len;$i++){
            $r = rand(0, (strlen($chars)-1));
            $pass .= $chars[$r];
        }
        return $pass;

    }
    static function change_password($userid, $newpassword){
        DB::update('user')->set(array('password' => self::encrypt_password($newpassword)))->where('user_id', '=', $userid)->execute();
    }
    static function check_password($userid, $password){
        $count = DB::select('user_id')->from('user')->where('user_id', '=', $userid)->where('password', '=', self::encrypt_password($password))->execute()->as_array();
        if(count($count) == 1){
            return true;
        } else {
            return false;
        }
    }
    static function get_user_fields($fields = array('fname', 'lname', 'user_id'), $id = false){
        if(!is_array($fields))
            $fields = array($fields);
        $sql = DB::select_array($fields)->from('user');
        if($id !== false){
            if(is_numeric($id))
                $sql->where('user_id', '=', $id);
            elseif(is_array($id))
                $sql->where('user_id', 'in', $id);
        }
        return $sql->execute()->as_array();
    }
}




?>