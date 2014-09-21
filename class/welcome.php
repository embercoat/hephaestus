<?php
class class_welcome extends class_common {
	function index(){
	    model::factory('renderer', 'temp')->posts = model::factory('post')->get_all();
	}
}