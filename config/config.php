<?php

define('DB_HOST','localhost');
define('DB_NAME','getmovie');
define('DB_PASS','');
define('DB_USER','root');
define('SITE_title','getMovie');
//define('DB_HOST','localhost');
?>
<?php

date_default_timezone_set("Europe/London");

try {
    $con = new PDO("mysql:dbname=getmovie;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    exit("Connection failed: " . $e->getMessage());
}
?>