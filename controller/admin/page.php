<?php

class controller_admin_page extends controller_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Sidor - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    function index(){
        $renderer = model::factory('renderer', 'page');
        $renderer->pages = model::factory('page')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/page/list.php', true);
    }
    function new_page(){
        if(isset($_POST) && !empty($_POST)){

            $id = model::factory('page')->add_page($_POST['title'], $_POST['body'], model_user::instance()->getId(), $sim);
            header('location: /admin/page/edit/'.$id);
        }
        $renderer = model::factory('renderer', 'page');
        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/page/edit.php', true);
    }
    function edit($id){
        if(isset($_POST) && !empty($_POST)){
            $sim = isset($_POST['show_in_menu']) ? 1 : 0;
            model::factory('page')->edit_page($_POST['title'], $_POST['body'], $_POST['idpage'], $sim);
        }

        $renderer = model::factory('renderer', 'page');
        $renderer->data = model::factory('page')->get_data($id);
        model::factory('renderer')->render_links = false;
        $renderer->render_links = false;

        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/page/edit.php', true);
    }
    function delete($id){
        model::factory('page')->delete($id);
        header('location: /admin/page');
    }
}