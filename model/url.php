<?php 

class model_url {
    function get_parts(){
        if(isset($_GET['cmd']))
            return explode('/', $_GET['cmd']);
        else
            return array('');
    }
    
} // End Welcome
