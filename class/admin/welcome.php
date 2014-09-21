<?php
class class_admin_welcome extends class_admin_common {
    function before(){
        model::factory('renderer')->admin_title = 'Adminpanel - '. model::factory('conf')->get_value('site_name');
        parent::before();
    }

	function index(){
		model::factory('renderer')->set('admin_content', 'hi');
	}
}