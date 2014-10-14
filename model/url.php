<?php 

class model_url {
    function get_parts(){
        if(isset($_GET['cmd']))
            $parts = explode('/', $_GET['cmd']);
        else
            $parts = array('');
        return $parts;
    }
    
} // End Welcome
