<!DOCTYPE html>
<?php require_once('config/autoload.php'); ?>
<?php require_once('config/paypalConfig.php');
      require_once("config/config.php");
      require_once("inc/lib/PreviewProvider.php");
      require_once("inc/lib/CategoryContainers.php");
      require_once("inc/lib/Entity.php");
      require_once("inc/lib/EntityProvider.php");
      require_once("inc/lib/ErrorMessage.php");
      require_once("inc/lib/SeasonProvider.php");
      require_once("inc/lib/Season.php");
      require_once("inc/lib/Video.php");
      require_once("inc/lib/VideoProvider.php");
      require_once("inc/lib/User.php");
?>

<?php
if(!isset($_SESSION['logn']['userUname'])) {
    header("Location: register.php");
}
$userLoggedIn = $_SESSION['logn']['userUname'];
?>
<html lang='zxx'>
<head>
    <meta charset='UTF-8'>
    <meta name='description' content='Amin Template'>
    <meta name='keywords' content='Amin, unica, creative, html'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!--<meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'>-->
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Get Movie</title>

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap'
        rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cinzel:400,700,900&display=swap' rel='stylesheet'>

    <!-- Css Styles -->
    <link rel='stylesheet' href='css/bootstrap.min.css' type='text/css'>
    <link rel='stylesheet' href='css/font-awesome.min.css' type='text/css'>
    <link rel='stylesheet' href='css/elegant-icons.css' type='text/css'>
    <link rel='stylesheet' href='css/owl.carousel.min.css' type='text/css'>
    <link rel='stylesheet' href='css/barfiller.css' type='text/css'>
    <link rel='stylesheet' href='css/magnific-popup.css' type='text/css'>
    <link rel='stylesheet' href='css/slicknav.min.css' type='text/css'>
    <link rel='stylesheet' href='css/style2.css' type='text/css'>
    <link rel='stylesheet' href='css/style1.css' type='text/css'>
    <link rel='stylesheet' href='css/style.css' type='text/css'>
</head>
<body>
    <!-- Page Preloder
        <div id='preloder'>
            <div class='loader'></div>
        </div> -->
    <!-- header Menu start -->
        <div id='header'class=''>
        <?php
         if(isset($hideNav)) {

         }else{
            require_once("inc/navBar.php");
         }
        ?>

        </div>
    <!-- Header Section end -->

    <!-- Breadcrumb Section Begin 
            <div class="container-fluid" style='position:absolute;'>
                <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                    <i class="fa fa-search sctnIcn pt-5" style='color:red;position:relative;right:-20px;'></i>
                    <input class="w-50 srch pt-5" type="text" placeholder="بحث"
                    aria-label="Search" style=''>
                </form>
            </div>    
    -->
        
