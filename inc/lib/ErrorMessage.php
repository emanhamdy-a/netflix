<?php
class ErrorMessage {
    public static function show($text){
       exit("<h1 class='col-12 text-center sctnIcn p-5 ar errorMessage'>" . $text . "</h1>");
    }
}

?>