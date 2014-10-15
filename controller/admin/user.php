<?php
class controller_admin_user extends controller_admin_common {
    function before(){
        $this->renderer = model::factory('renderer', 'user');
        model::factory('renderer')->admin_title = 'Användare  - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }
    function index(){
        $r = model::factory('database')->safe_query('select * from user order by fname ASC, lname ASC');
        $this->renderer->users = $r;
        model::factory('renderer')->admin_content = $this->renderer->render('template/admin/user/list.php', true);

    }
    function new_user(){
        if(isset($_POST) && !empty($_POST)){
            if($_POST['password'] == $_POST['password2']){
                $r = model::factory('user')->create_user('', '', $_POST['username'], model::factory('user')->encrypt_password($_POST['password']));
                model::factory('message')->add('Successfully created user: '.$_POST['username'], 'success');
            } else {
                model::factory('message')->add('Something went wrong', 'error');
            }
        }
        model::factory('renderer')->add_css('/css/form.css');
        model::factory('renderer')->admin_content = $this->renderer->render('template/admin/user/new_user.php', true);
    }
    function delete($id){
        model:factory('user')->delete($id);
        header('location: /admin/user/');

    }
}