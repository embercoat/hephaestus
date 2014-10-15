<?php

class controller_admin_file extends controller_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Filer - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    function index(){
        $renderer = model::factory('renderer', 'file');
        $renderer->files = model::factory('file')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/file/list.php', true);
    }
    function new_file(){
        if(isset($_POST) && !empty($_POST)){
            $id = model::factory('file')->add_file(
                                             $_FILES['file']['name'],
                                             $_POST['title'],
                                             $_FILES['file']['type'],
                                             file_get_contents($_FILES['file']['tmp_name']),
                                             model_user::instance()->getId()
                                        );
            header('location: /admin/file/');
        }
        $renderer = model::factory('renderer', 'post');
        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/file/edit.php', true);
    }
    function delete($id){
        model::factory('file')->delete($id);
        header('location: /admin/file');
    }
}