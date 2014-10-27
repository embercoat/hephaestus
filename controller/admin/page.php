<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 * Same basic principles as the file-controller. Allows for management of semi-static pages and their content.
 */
class controller_admin_page extends controller_admin_common {
    /*
     * Before
     */
    function before(){
        model::factory('renderer')->admin_title = 'Sidor - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    /*
    * If no action is declared, index is called.
    * This one just lists all the pages created and available.
    */
    function index(){
        $renderer = model::factory('renderer', 'page');
        $renderer->pages = model::factory('page')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/page/list.php', true);
    }
    /*
     * Create new page
     *
     * If a form is submitted to this adress the post is added to the database and user is sent to the edit-page of that post.
     */
    function new_page(){
        
        if(isset($_POST) && !empty($_POST)){
            $id = model::factory('page')->add_page($_POST['title'], $_POST['body'], model_user::instance()->getId(), $sim);
            header('location: '.model::factory('renderer')->url('/admin/page/edit/'.$id));
        }
        $renderer = model::factory('renderer', 'page');
        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/page/edit.php');
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
        $page = $renderer->render('template/admin/page/edit.php', true);
        return model::factory('renderer')->admin_content = $page;
    }
    function delete($id){
        model::factory('page')->delete($id);
        header('location: '.model::factory('renderer')->url('/admin/page'));
    }
}