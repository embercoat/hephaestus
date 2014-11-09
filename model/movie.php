<?php
class model_movie {
    private $default_poster_id = '';
    function get_all(){
        return model::factory('database')->query('select * from movie order by name asc');
    }
    function add_movie($name, $year, $desc, $poster){
        model::log()->debug('Add Movie Poster size: '.$poster['size']);
        if($poster['size'] > 0) {
            $poster_file_id = model::factory('file')->add_file(
                            $poster['name'],
                            'Poster for '.$name,
                            $poster['type'],
                            file_get_contents($poster['tmp_name']),
                            model::factory('user')->instance()->getId()
                            );
        } else {
            $poster_file_id = $this->default_poster_id;
        }
        
        $sql = 'insert into movie (name, year, description, poster) values (:name, :year, :description, :poster)';
        $params = array('name' => $name, 'description' => $desc, 'poster' => $poster_file_id, 'year' => $year);
        return model::factory('database')->insert($sql, $params);
    }
    function edit_movie($movie_id, $name, $year, $desc, $poster){
        list($poster_id) = model::database()->safe_query('select poster from movie where movie_id=?', $movie_id);
        $poster_file_id = $poster_id['poster'];
        if(!empty($poster) && $poster['size'] > 0) {
            if($poster_file_id !== ""){
                model::factory('file')->edit_file(
                                        $poster_file_id,
                                        $poster['name'],
                                        'Poster for '.$name,
                                        $poster['type'],
                                        file_get_contents($poster['tmp_name']),
                                        model::factory('user')->instance()->getId()
                                        );
            } else {
                $poster_file_id = model::file()->add_file(
                                        $poster['name'],
                                        'Poster for'.$name,
                                        $poster['type'],
                                        file_get_contents($poster['tmp_name']),
                                        model::user()->instance()->getId()
                                    );
            }
        } else {
            if(empty($poster_file_id)){
                $poster_file_id = $this->default_poster_id;
            }
        }
        $params = array(
                    'name' => $name,
                    'description' => $desc,
                    'poster' => $poster_file_id,
                    'movie_id' => $movie_id,
                    'year' => $year
                );
        $sql = 'update movie set name=:name, year=:year, description=:description, poster=:poster where movie_id=:movie_id';
        model::factory('database')->safe_query($sql, $params);
    }

    function get_data($id){
        $res = model::factory('database')->safe_query('select * from movie where movie_id=?', $id);
        if(count($res))
            return $res[0];

        return false;
    }
    function delete($id){
        $sql = 'delete from movie where movie_id=?';
        model::factory('database')->safe_query($sql, $id);
    }
}