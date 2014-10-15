<?php
class controller_page extends controller_common {
    function __call($name, $args){
        $this->page($name);
    }
    function page($page){
        list($id, $null) = explode(':', $page);
        $sql = 'select * from page where idpage="'.$id.'"';
        list($page) = model::factory('database')->query($sql);
        $page_renderer = model::factory('renderer', 'pages');
        $page_renderer->page = $page;

        model::factory('renderer')->content = $page_renderer->render('template/page.php');
    }
}