<?php

$pages = model::factory('page')->get_all(true);
$str = '<ul>';
foreach($pages as $p){
    $str .= '<li><a href="[[[page:'.$p['idpage'].']]]">'.$p['title'].'</a></li>';
}
$str .= '</ul>';
echo $str;

