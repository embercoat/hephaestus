<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 * File management functionality. Allows for listing, uploading and deleting files.
 * 
 */
class controller_admin_file extends controller_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Filer - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }
    /*
     * If no action is declared, index is called.
     * This one just lists all the files uploaded to the site.
     */
    function index(){
        // Create a local rendering object
        $renderer = model::factory('renderer', 'file');
        // Add an array containing all the files to it
        $renderer->files = model::factory('file')->get_all();
        // pass the resulting html-code back to the main rendering-object.
        model::factory('renderer')->admin_content = $renderer->render('template/admin/file/list.php', true);
    }
    function new_file(){
        // If a form was posted, add a file to the site.
        if(isset($_POST) && !empty($_POST)){
            $id = model::factory('file')->add_file(
                                             $_FILES['file']['name'],
                                             $_POST['title'],
                                             $_FILES['file']['type'],
                                             file_get_contents($_FILES['file']['tmp_name']),
                                             model_user::instance()->getId()
                                        );
            // and send user to file list
            header('location: '.model::factory('renderer')->url('/admin/file/'));
        }
        // if not render an addition form
        $renderer = model::factory('renderer', 'post');
        model::factory('renderer')->add_css('/css/form.css');
        model::factory('renderer')->admin_content = $renderer->render('template/admin/file/edit.php', true);
    }
    /*
     * simply deletes a file with the provided ID
     * @param int id file id number
     */
    function delete($id){
        // Let the file-model deal with the deletion
        model::factory('file')->delete($id);
        // and send the user back to the filelist
        header('location: '.model::factory('renderer')->url('/admin/file/'));
    }
}