<?php

class controller_kmom2 {
    function before(){
        # Persistency
        $session = model::factory('session');
        if(in_array('gamedata', model::factory('session')->get_list())){
            $this->gamedata = model::factory('session')->get('gamedata');
        } else {
            $this->gamedata = model::factory('kmom2_dicegame');
        }
        $this->dicegame_render = model::factory('renderer', 'dicegame');

    }
    function after(){
        model::factory('session')->set('gamedata', $this->gamedata);
    }
    
    function index(){
        $this->dicegame_render->sum_round = $this->gamedata->sum_round();
        $this->dicegame_render->sum_all = $this->gamedata->sum_all();
        $this->dicegame_render->last_roll = $this->gamedata->last_roll;
        $this->dicegame_render->round = $this->gamedata->number_of_rounds_played();

        model::factory('renderer')->content = $this->dicegame_render->render('template/kmom2/welcome.php');
        
    }
    function roll(){
        $this->gamedata->roll();
        header('Location: /kmom2/');
    }
    function next(){
        $this->gamedata->next();
        header('Location: /kmom2/');
    }
    function clear(){
        $this->gamedata->clear();
        header('Location: /kmom2/');
    }
}
