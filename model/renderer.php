<?php

class model_renderer {
    private static $instance;
    private $content = array();
    private $css = array();
    private $js = array();
    public $render_links = true;

    function __set($name, $value){
        $this->content[$name] = $value;
    }
    function __get($name){
        if(isset($this->content[$name]))
            return $this->content[$name];
        else
            return false;
    }
    function get($name){
    	return $this->__get($name);
    }
    function set($name, $value){
    	$this->__set($name, $value);
    }
    function add_css($uri){
        $this->css[] = $uri;
        $this->css = array_unique($this->css);
    }
    function add_js($uri){
        $this->js[] = $uri;
        $this->js = array_unique($this->js);
    }
    function render($basefile, $by_include = false){
	extract($this->content);
	ob_start();
	include(BASEPATH.$basefile);
	$page = ob_get_contents();
	ob_end_clean();

        $tmp = '';
        do {
            $tmp = $page;
            if($this->render_links)
                $page = preg_replace_callback('/\[\[\[(.*?)\]\]\]/', array($this, 'render_link'), $page);
            $page = preg_replace_callback('/:::(.*?):::/', array($this, 'render_functions'), $page);
            $page = preg_replace_callback('/###(.*?)###/', array($this, 'render_content'), $page);
        } while ($page != $tmp);

        return $page;
    }
    function render_css(){
        $imports = array();
        foreach($this->css as $c){
            $imports[] = '@import url('.$c.');';
        }
        return implode("\r\n", $imports);
    }

    function render_functions($content){
        if(strstr($content[1], ':')){
            list($func, $param) = explode(':', $content[1], 2);
            if(method_exists($this, $func)){
                return call_user_func(array($this, $func), $param);
            } else
                return $content[0];

        } else {
            if(method_exists($this, $content[1])){
                return call_user_func(array($this, $content[1]));
            } else
                return $content[0];

        }


    }
    function render_link($content){
        if(strstr($content[1], ':')){
            list($func, $param) = explode(':', $content[1], 2);
            if(method_exists($this, $func)){
                return call_user_func(array($this, $func), $param);
            } else
                return $content[0];

        } else {
            if(method_exists($this, $content[1])){
                return call_user_func(array($this, $content[1]));
            } else
                return $content[0];

        }
    }
    function url($url){
	if($url[0] == '/')
	    $url = substr($url, 1);
	return BASEURL.$url;
    }
    function file($id){
        if(is_numeric($id)){
            $sql = "select path, filename, type from file where idfile = '".$id."'";
        } else {
            $sql = "select path, filename, type from file where filename = '".$id."'";
        }
        list($data) = model::factory('database')->query($sql);
        if(!empty($data))
            return '/file/get/'.$id;
        else
            return 'no image with that id';

    }
    function post($id){
        $sql = "select title from post where idpost = '".$id."'";
        list($data) = model::factory('database')->query($sql);
        if(!empty($data))
            return $this->url('/post/'.$id.':'.$this->url_safe($data['title']));
        else
            return 'no post with that id';

    }
    function page($id){
        $sql = "select title from page where idpage = '".$id."'";
        list($data) = model::factory('database')->query($sql);
        if(!empty($data))
            return $this->url('/page/'.$id.':'.$this->url_safe($data['title']));
        else
            return 'no page with that id';

    }
    function title($id){
	$sql = "select title from page where idpage = '".$id."'";
        list($data) = model::factory('database')->query($sql);
        if(!empty($data))
            return $data['title'];
        else
            return 'no page with that id';
    }
    function csource($path){
		//The @ is to suppress the strict standards-warning and not have to store explode's result before popping it
		return '<a href="/csource/?path='.$path.'">'.@array_pop(explode('/', $path)).'</a>';
	}
    function render_content($content){
    	if($this->__get($content[1]))
    		return $this->__get($content[1]);
        $path = str_replace('_', '/', BASEPATH.'content/'.$content[1].'.php');
        if(is_file($path)){
			ob_start();
            include($path);
			$content = ob_get_contents();
			ob_end_clean();
			return $content;
			
		} else
            return $content[0];
    }
    function url_safe($string){
        $src = array(' ', '--', '!', '"');
        $tmp = '';
        do {
            $tmp = $string;
            $string = str_replace($src, '-', $string);
        } while ($string != $tmp);

        return $tmp;
    }
}


?>