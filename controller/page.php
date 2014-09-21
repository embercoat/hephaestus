<?php
class controller_page extends controller_common {
    function __call($name, $args){
        $this->page($name);
    }
    function page($page){
        list($id, $null) = explode(':', $page);
        $sql = 'select * from page where idpage="'.$id.'"';
        $page = model::factory('database')->query($sql)->fetch_assoc();
        $page_renderer = model::factory('renderer', 'page');
        $page_renderer->page = $page;
        model::factory('renderer')->content = $page_renderer->render('template/page.php', true);
    }
}