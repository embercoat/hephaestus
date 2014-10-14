<?php

class model_kmom2_dicegame extends model_kmom2_gamedata {
    private $gamename = 'dices';
    public $last_roll;
    
    function __construct(){
        $this->set_data($this->gamename, array('players' => array(
                                                array(
                                                    'rounds' => array(),
                                                    'name' => 'Player'
                                                )
                                            ),
                                            'current_player' => 0
                               ));
        $this->last_roll = 0;
    }
    function roll(){
        $roll = model::factory('kmom2_randomize')->roll_dice(6);
        $rounds = $this->get_data($this->gamename);
        
        $current_round = count($rounds['players'][$rounds['current_player']]['rounds']);
        if($current_round == 0 && !isset($rounds['players'][$rounds['current_player']]['rounds'][$current_round])){
            $rounds['players'][$rounds['current_player']]['rounds'][] = array();
        }
        if($roll != 1){
            $rounds['players'][$rounds['current_player']]['rounds'][count($rounds['players'][$rounds['current_player']]['rounds'])-1][] = $roll;
        } else {
            $rounds['players'][$rounds['current_player']]['rounds'][count($rounds['players'][$rounds['current_player']]['rounds'])-1] = array();
            $rounds['players'][$rounds['current_player']]['rounds'][count($rounds['players'][$rounds['current_player']]['rounds'])] = array();
        }
        $this->last_roll = $roll;
        $this->set_data($this->gamename, $rounds);
    }
    function next(){
        $rounds = $this->get_data($this->gamename);
        $current_round = count($rounds['players'][$rounds['current_player']]['rounds']);
        $rounds['players'][$rounds['current_player']]['rounds'][$current_round] = array();
        $this->set_data($this->gamename, $rounds);
    }
    function clear(){
        $this->__construct();
    }
    function sum_round(){
        $rounds = $this->get_data($this->gamename);
        $current_round = count($rounds['players'][$rounds['current_player']]['rounds'])-1;
        if($current_round == -1)
            return 0;
        else 
            return array_sum($rounds['players'][$rounds['current_player']]['rounds'][$current_round]);
        
    }
    function sum_all(){
        $sum = 0;
        $rounds = $this->get_data($this->gamename);
        foreach($rounds['players'][$rounds['current_player']]['rounds'] as $rolls){
            $sum += array_sum($rolls);
        }
        return $sum;
    }
    function number_of_rounds_played(){
        $rounds = $this->get_data($this->gamename);
        return count($rounds['players'][$rounds['current_player']]['rounds']);
    }
}
