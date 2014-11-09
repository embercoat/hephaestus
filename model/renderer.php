<?php
/**
 * The magic renderer
 *
 * This is where most of the magic happens
 */
class model_renderer {
	/**
	 * A few class variables to start things off.
	 */
    private static $instance;
    private $content = array();
    private $css = array();
    private $js = array();
    public $render_links = true;
	private $textareas = array();

	/**
	 * Overloading the regular __set allows for $classinstance->item = 'value'; even if item does not already exist
	 */
    function __set($name, $value){
        $this->content[$name] = $value;
    }
	/**
	 * Similar to __set above
	 */
    function __get($name){
        if(isset($this->content[$name]))
            return $this->content[$name];
        else
            return false;
    }
	/**
	 * Get and set are just aliases for __get and __set
	 */
    function get($name){
    	return $this->__get($name);
    }
    function set($name, $value){
    	$this->__set($name, $value);
    }
	/**
	 * add extra linked resources to the finished page.
	 */
    function add_css($uri){
        $this->css[] = $uri;
        $this->css = array_unique($this->css);
    }
    function add_js($uri){
        $this->js[] = $uri;
        $this->js = array_unique($this->js);
    }
	/**
	 * The magic renderer
	 *
	 * Right here is where all of the final rendering happens.
	 * @param string $basefile the basefile to base the rendering on
	 * @param bool $by_include backwards compatibility. Now deprecated
	 */
    function render($basefile, $by_include = false){
		extract($this->content);
		ob_start();
		include(BASEPATH.$basefile);
		$page = ob_get_contents();
		ob_end_clean();

		$matches = array();
		
        $tmp = '';
        do {
            $tmp = $page;
			model::factory('log')->information('Renderingloop');
			
			//Exclude textarea from replacements
			$page = preg_replace_callback('/<textarea.*?>[\s\S]*?<\/textarea>/mi', array($this, 'save_textarea'), $page);

            if($this->render_links)
                $page = preg_replace_callback('/\[\[\[(.*?)\]\]\]/', array($this, 'render_link'), $page);

            $page = preg_replace_callback('/:::(.*?):::/', array($this, 'render_functions'), $page);
            $page = preg_replace_callback('/###(.*?)###/', array($this, 'render_content'), $page);
			$page = preg_replace_callback('/<textarea:([\s\S]{32})\/>/mi', array($this, 'restore_textarea'), $page);
        } while ($page != $tmp);
		
        return $page;
    }
	function save_textarea($content){
		$md5 = md5($content[0]);
		model::factory('log')->information("Saving textarea to: ".$md5);
		$this->textareas[$md5] = $content[0];
		return '<textarea:'.$md5.'/>';
	}
	function restore_textarea($content){
		model::factory('log')->information("Restoring textarea: ".$content[1]);
		return $this->textareas[$content[1]];
	}
	
    function render_css(){
		model::factory('log')->information("Rendering CSS");
        $imports = array();
        foreach($this->css as $c){
            $imports[] = '@import url(:::url:'.$c.':::);';
        }
        return implode("\r\n", $imports);
    }

    function render_functions($content){
		model::factory('log')->information("Rendering function: ".$content[1]);
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
		model::factory('log')->information("Rendering Link: ".$content[1]);

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
		model::factory('log')->information("Replacing url: ".$url);

		if($url[0] == '/')
			$url = substr($url, 1);
		if(strstr($url, BASEURL) == 0){
			return BASEURL.$url;
		} else {
			return $url;
		}
    }
    function file($id = false){
		if($id !== false){
			model::factory('log')->information("Replacing file: ".$id);
	
			if(is_numeric($id)){
				$sql = "select path, filename, type from file where idfile = '".$id."'";
			} else {
				$sql = "select path, filename, type from file where filename = '".$id."'";
			}
			$data = model::factory('database')->query($sql);
			if(!empty($data))
				return $this->url('/file/get/'.$id);
			else
				return 'no image with that id';
		} else {
			return 'no image with that id';
		}

    }
    function post($id){
		model::factory('log')->information("Replacing post: ".$id);

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
	function href($link, $title = false){
		if(!$title)
			$title = $link;
		return '<a href="'.$this->url($link).'">'.$title.'</a>';
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
		
        $path = str_replace('_', '/', BASEPATH.'template/'.$content[1].'.php');
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