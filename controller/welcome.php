<?php
class controller_welcome extends controller_common {
	function index(){
	    model::factory('renderer', 'temp')->posts = model::factory('post')->get_all();
	}
}