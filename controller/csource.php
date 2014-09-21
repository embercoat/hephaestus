<?php
class controller_csource{
    function index(){
      model::factory('renderer')->content = model::factory('renderer')->render('template/csource.php');
    }
}