<?php
class controller_file extends controller_common{
	function before(){
		$debug = model::debug();
		$debug::$inhibit = true;
	}
	
	function get($file){
	    if(is_numeric($file)){
        	$sql = "select path, filename, type from file where idfile = '".$file."'";
	    } else {
        	$sql = "select path, filename, type from file where filename = '".$file."'";
	    }
	    list($data) = model::factory('database')->query($sql);
	    header('Content-Description: File Transfer');
        header('Content-Type: '.$data['type']);
        $mime = explode('/', $data['type']);
        if($mime[0] != 'image'){
            header('Content-Disposition: attachment; filename='.$data['filename']);
        }
        header('Pragma: public');
        header('Content-Length: ' . filesize(UPLOAD.$data['path']));
        readfile(UPLOAD.$data['path']);
        die();
	}
}