<?php
ob_start(); // Turns on output buffering
session_start();
 require_once "../config/config.php";
 date_default_timezone_set("Africa/Cairo");
function __autoload($classnm){
    require_once("../inc/lib/" . $classnm . ".php");
}
if(isset($_POST["term"]) && isset($_POST["username"])) {
    $srp= new SearchResultsProvider($con,$_POST['username']);
    echo $srp->getResults($_POST["term"]);
} else {
    echo "No term or username passed into file";
}
?>