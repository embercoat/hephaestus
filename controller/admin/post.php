<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 * 
 */
class controller_admin_post extends controller_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Postningar - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    function index(){
        $renderer = model::factory('renderer', 'post');
        $renderer->posts = model::factory('post')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/post/list.php', true);
    }
    function new_post(){
        if(isset($_POST) && !empty($_POST)){
            $id = model::factory('post')->add_post($_POST['title'], $_POST['body'], model_user::instance()->getId());
            header('location:  '.model::factory('renderer')->url('/admin/post/edit/'.$id));
        }
        $renderer = model::factory('renderer', 'post');
        model::factory('renderer')->add_css('/css/form.css');

        return model::factory('renderer')->admin_content = $renderer->render('template/admin/post/edit.php', true);
    }
    function edit($id){
        if(isset($_POST) && !empty($_POST)){
            model::factory('post')->edit_post($_POST['title'], $_POST['body'], $_POST['idpost']);
        }

        $renderer = model::factory('renderer', 'post');
        $renderer->data = model::factory('post')->get_data($id);
        model::factory('renderer')->render_links = false;
        $renderer->render_links = false;

        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/post/edit.php', true);
    }
    function delete($id){
        model::factory('post')->delete($id);
        header('location: '.model::factory('renderer')->url('/admin/post'));
    }
}