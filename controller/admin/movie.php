<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */

class controller_admin_movie extends controller_admin_common {
    /*
     * Before
     */
    function before(){
        model::factory('renderer')->admin_title = 'Filmer - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

    /*
    * If no action is declared, index is called.
    * This one just lists all the pages created and available.
    */
    function index(){
        $renderer = model::factory('renderer', 'movie');
        $renderer->movies = model::factory('movie')->get_all();
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/movie/list.php', true);
    }
    /*
     * Create new page
     *
     * If a form is submitted to this adress the post is added to the database and user is sent to the edit-page of that post.
     */
    function new_movie(){
        
        if(isset($_POST) && !empty($_POST)){
            /*
             * @todo fix the poster thingy. should take an upload and do stuff
             */
            $poster = '';
            $id = model::factory('movie')->add_movie($_POST['name'], $_POST['year'], $_POST['description'], $_FILES['poster']);
            header('location: '.model::factory('renderer')->url('/admin/movie/edit/'.$id));
        }
        $renderer = model::factory('renderer', 'movie');
        model::factory('renderer')->add_css('/css/form.css');
        return model::factory('renderer')->admin_content = $renderer->render('template/admin/movie/edit.php');
    }
    function edit($id){
        if(isset($_POST) && !empty($_POST)){
            /*
             * @todo fix the poster thingy. should take an upload and do stuff
             */
            model::factory('movie')->edit_movie($_POST['movie_id'], $_POST['name'], $_POST['year'], $_POST['description'], $_FILES['poster']);
        }

        $renderer = model::factory('renderer', 'movie');
        $renderer->data = model::factory('movie')->get_data($id);
        model::factory('renderer')->render_links = false;
        $renderer->render_links = false;

        model::factory('renderer')->add_css('/css/form.css');
        $page = $renderer->render('template/admin/movie/edit.php', true);
        return model::factory('renderer')->admin_content = $page;
    }
    function delete($id){
        model::factory('movie')->delete($id);
        header('location: '.model::factory('renderer')->url('/admin/movie'));
    }

}