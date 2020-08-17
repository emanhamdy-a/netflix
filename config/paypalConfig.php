<?php
require_once("PayPal-PHP-SDK/autoload.php");
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
         'AcCObd92WkyGEDmZoLkYTuZYmLSce-OcAjCJS8juv6qlRegHVdl16xkhmW1byGfBqvHtUCxtTpuSOKYn',     // ClientID
         'ELcbiRY3SI9Gipqx5f7NJKo-qPSmwncipcFp16w_yZx95_9VbcxPkI47q0ofVNMCJzA2A4iLT0IAXat_'    // ClientSecret
       /*'AVRhLtXg1klEAQYXu86-DiP-Pet_ZYmZQ8vpIzt3gcFdVtG3dBRQbS3ZLl-OSKI5oLdKKHFzesKI4_fT',     //reece ClientID
        'EPN-Jhvtql-CtMhZW3sdXJEqNyfdqjLFLMNRVmp-lFs0Or1vY1XvA6VOQoW6sf50ARpJc6HWG4rW1hNT'    */    // ClientSecret*/
    )
);
?>