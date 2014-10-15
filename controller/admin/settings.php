<?php

class controller_admin_settings extends controller_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Inställningar - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    function index(){
        if(isset($_POST) && !empty($_POST)){
            foreach($_POST as $key => $p){
                model::factory('conf')->set($key, $p);
            }
        }
        $renderer = model::factory('renderer', 'settings');
        $renderer->settings = model::factory('conf')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/settings/index.php', true);
    }
}