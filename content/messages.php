<?php
if(model::factory('message')->get()){
    $str = "<ul>\r\n";
    foreach(model::factory('message')->get() as $class => $cont)
        foreach($cont as $m)
            $str .= '<li class="'.$class.'">'.$m.'</li>';
    $str .= "</ul>";
    model::factory('message')->clear();
    echo $str;
} else {
    
}
