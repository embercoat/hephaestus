<?php
class model_post {
    function get_all($only_in_menu = false){
        $sql = 'select * from post order by timestamp desc';
        return model::factory('database')->query($sql);
        /*$return = array();
        while($row = $res->fetch_assoc())
            $return[] = $row;

        return $return;*/
    }
    function add_post($title, $body, $user){
        $sql = 'insert into post (title, content, author, timestamp) values ("'.$title.'", "'.$body.'", "'.$user.'", "'.time().'")';
        model::factory('database')->query($sql);
        return model::factory('database')->get_connection()->insert_id;

    }
    function edit_post($title, $body, $idpost){
        $sql = 'update post set title="'.$title.'", content="'.model::factory('database')->escape($body).'", timestamp="'.time().'" where idpost="'.$idpost.'"';
        model::factory('database')->query($sql);
    }

    function get_data($id){
        $res = model::factory('database')->query('select * from post where idpost ="'.$id.'"');
        $return = array();
        if(count($res))
            return $res[0];

        return false;
    }
    function delete($id){
        $sql = 'delete from post where idpost = "'.$id.'"';
        model::factory('database')->query($sql);
    }
}