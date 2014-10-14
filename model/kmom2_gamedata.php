<?php
class model_kmom2_gamedata {
    static $gamedata;
    static $players;
    function set_data($game, $data){
        $this->gamedata[$game] = array_merge($this->gamedata[$game], $data);
    }
    function get_data($game){
        return $this->gamedata[$game];
    }
    function add_player($game, $name){
        $id = md5(rand());
        
        if(!isset($this->players[$game]))
            $this->players[$game] = array();
            
        $this->players[$game][$id] = array('name' => $name);
        $this->set_data($game, array('num_players' => count($this->players[$game])));
        return $id;
    }
    function rm_player($id){
        unset($this->players[$id]);
        $this->set_data($game, array('num_players' => count($this->players[$game])));
    }
    function set_player_data($game, $id, $data){
        $this->players[$game][$id] = array_merge($this->players[$game][$id], $data);
    }
    function get_player($game, $id = false){
        if($id){
            return $this->players[$game][$id];
        } else {
            return $this->players[$game];
        }
    }
}
