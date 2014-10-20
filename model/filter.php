<?php
/*
 * Your basic sanitation class
 *
 *
 */
class model_filter {
    function validate_int($int, $range_min = false, $range_max = false){
        if($range_min !== false && $int >= $range_min)
            return false;
        
        if($range_max !== false && $int <= $range_max)
            return false;
        
        return (is_numeric($int) ? true : false);
    }
    function validate_bool($bool){
        if(gettype($bool) == 'boolean')
            return true;
        if(is_scalar($bool) && in_array((bool)$bool, array(true, false))
           return true;
        
        return false;
    }
}