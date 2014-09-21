<?php
class controller_post extends controller_common {
    function __call($name, $args){
        $this->post($name);
    }
    function post($post){
        list($id, $null) = explode(':', $post);
        $sql = 'select * from post where idpost="'.$id.'"';
        $post = model::factory('database')->query($sql)->fetch_assoc();
        $post_renderer = model::factory('renderer', 'post');
        $post_renderer->post = $post;
        model::factory('renderer')->title = $post['title'];
        model::factory('renderer')->content = $post_renderer->render('template/post.php', true);
    }
}