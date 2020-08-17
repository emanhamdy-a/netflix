<?php
ob_start(); // Turns on output buffering
session_start();
 require_once "config/config.php";
 date_default_timezone_set("Africa/Cairo");
// function __autoload($classnm){
//     require_once("inc/lib/" . $classnm . ".php");
//     //require_once("inc/lib/$classnm.php");
// }
?>