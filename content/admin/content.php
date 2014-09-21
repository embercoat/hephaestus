<?php
$parts = model::factory('url')->get_parts();
$parts[1] = ((isset($parts[1])) ? $parts[1] : '');
$parts[2] = ((isset($parts[2])) ? $parts[2] : '');

switch($parts[0]){
    case 'admin':{
        switch($parts[1]){
            case 'user':{
                switch($parts[2]){
                    default:{

                    break;
                    }
                }

            break;
            }
        }
    break;
    }

}



echo 'content';
