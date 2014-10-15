<?php
class controller_admin_common{
    function before(){
        model::factory('renderer')->admin_mainhead = 'Adminpanel för '. model::factory('conf')->get_value('site_name');
    }
}