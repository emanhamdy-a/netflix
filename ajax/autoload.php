<?php
 ob_start();
 session_start();
 //config file
 require_once "../config/config.php";
 date_default_timezone_set("Africa/Cairo");
 //include helper
 //require_once "helper/system_helper.php";
function __autoload($classnm){
    require_once("../inc/lib/" . $classnm . ".php");
}
?>