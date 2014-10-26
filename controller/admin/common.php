<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 * This is the common controller for all admin-controllers. Can be used to set stuff that should be done in all controllers.
 * All admin-controllers extend this class and should call parent::before() if overloaded.
 * 
 */
class controller_admin_common{
    /*
     * Function to be called before anything else in this controller
     */
    function before(){
        model::factory('renderer')->admin_mainhead = 'Adminpanel för '. model::factory('conf')->get_value('site_name');
    }
}