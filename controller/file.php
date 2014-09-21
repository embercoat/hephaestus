<?php
class controller_file extends controller_common{
	function get($file){
	    if(is_numeric($file)){
	        $sql = "select path, filename, type from file where idfile = '".$file."'";
	    } else {
	        $sql = "select path, filename, type from file where filename = '".$file."'";
	    }
	    $data = model::factory('database')->query($sql)->fetch_assoc();
	    header('Content-Description: File Transfer');
        header('Content-Type: '.$data['type']);
        $mime = explode('/', $data['type']);
        if($mime[0] != 'image'){
            header('Content-Disposition: attachment; filename='.$data['filename']);
        }
        header('Pragma: public');
        header('Content-Length: ' . filesize(UPLOAD.$data['path']));
        ob_clean();
        flush();
        readfile(UPLOAD.$data['path']);
        die();


	}
}