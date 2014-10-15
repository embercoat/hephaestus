<?php
class model_file {
    function get_all(){
        $res = model::factory('database')->safe_query('select * from file order by filename desc');
        $return = array();
        foreach($res as $row)
            $return[] = $row;

        return $return;
    }
    function add_file($filename, $name, $type, $data, $user){
        $filemd5 = md5($data);
        file_put_contents(UPLOAD.$filemd5, $data);
        $sql = 'insert into file (filename, name, path, type, author, timestamp) values (:filename, :name, :md5, :type, :user, :time)';
        $params = array(
                        'filename' => $filename,
                        'name' => $name,
                        'md5' => $filemd5,
                        'type' => $type,
                        'user' => $user,
                        'time' => time()
                    );
        return model::factory('database')->insert($sql, $params);
    }
    function get_info($id){
        $res = model::factory('database')->query('select * from file where idfile ="'.$id.'"');
        $return = array();
        while($row = $res->fetch_assoc())
            return $row;

        return false;
    }
    function delete($id){
        $sql = 'delete from file where idfile = "'.$id.'"';
        model::factory('database')->query($sql);
    }
}