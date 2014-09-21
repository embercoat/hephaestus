<?php
class model_page {
    function get_all(){
        $res = model::factory('database')->query('select * from page order by timestamp desc');
        $return = array();
        while($row = $res->fetch_assoc())
            $return[] = $row;

        return $return;
    }
    function add_page($title, $body, $user, $show_in_menu){
        $sql = 'insert into page (title, content, author, timestamp, show_in_menu) values ("'.$title.'", "'.$body.'", "'.$user.'", "'.time().'", "'.$show_in_menu.'")';
        model::factory('database')->query($sql);
        return model::factory('database')->get_connection()->insert_id;

    }
    function edit_page($title, $body, $idpage, $show_in_menu){
        $sql = 'update page set title="'.$title.'", content="'.$body.'", timestamp="'.time().'", show_in_menu="'.$show_in_menu.'" where idpage="'.$idpage.'"';
        model::factory('database')->query($sql);
    }

    function get_data($id){
        $res = model::factory('database')->query('select * from page where idpage ="'.$id.'"');
        $return = array();
        while($row = $res->fetch_assoc())
            return $row;

        return false;
    }
    function delete($id){
        $sql = 'delete from page where idpage = "'.$id.'"';
        model::factory('database')->query($sql);
    }
}