<!DOCTYPE html>
<?php require_once('config/autoload.php'); ?>
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
    <link rel='stylesheet' href='css/magnific-popup.css' type='text/css'>
    <link rel='stylesheet' href='css/style2.css' type='text/css'>
    <link rel='stylesheet' href='css/style1.css' type='text/css'>
</head>
<body>
    <div class='container-fluid pt-5'>
        <div class='row pt-5'>
            <div class='col-12 text-center p-5 '>
                <div class='ht-widget pt-5'>
                    <ul>
                        <li style='cursor:pointer;'class='pt-5'>
                            <i class='fa fa-sign-in sctnIcn pr-3' style='font-size:33px;'></i>
                            <a class='search-switch search-open' style='font-size:33px;color:white;'> Login /<a>
                            <a class='signup-switch signup-open' style='font-size:33px;color:white;'> Sign up<a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- Sign Up Section Begin -->
    <div class='signup-section'>
        <div class='signup-close'style='position:absolute;z-index:99;top:50px;'><i class='fa fa-close'></i></div>
        <div class='signup-text'>
            <div class='container'>
                <div class='signup-title'>
                    <h2 id='signTitle'>Sign up</h2>
                </div>
                <form action='' class='signup-form' id='signUp' method=''>
                    <div class='sf-input-list mb-3'>
                        <div class='text-right col-12 mb-1' id='MsignUn'></div>
                        <input type='text' class='input-value signUP' name='signUn' id='signUn' placeholder='User Name*'>
                        <div class='text-right col-12 mb-1' id='MsignFn'></div>
                        <input type='text' class='input-value signUP' name='signFn' id='signFn' placeholder='Full Name'>
                        <div class='text-right col-12 mb-1' id='MsignPs'></div>
                        <input type='text' class='input-value signUP' name='signPs' id='signPs' placeholder='Password'>
                        <div class='text-right col-12 mb-1' id='MsignCp'></div>
                        <input type='text' class='input-value signUP' name='signCp' id='signCp' placeholder='Confirm Password'>
                        <div class='text-right col-12 mb-1' id='MsignEm'></div>
                        <input type='text' class='input-value signUP' name='signEm' id='signEm' placeholder='Email Address'>
                    </div>
                    <button type='' name='signBtn' id='signBtn'><span>REGISTER NOW</span></button>
                </form>
            </div>
        </div>
     </div>
    <!-- Sign Up Section End -->

    <!-- Sign in Section Begin -->
     <div class='search-model'>
        <div class='search-close-switch border-danger'style=''>+</i></div>
        <div class='signup-text'>
            <div class='container'>
                <div class='signup-title'>
                    <h2 id='logInTitl'>Sign in</h2>
                </div>
                <form action='' class='signup-form' id='LogIn'name='LogIn'>
                    <div class='sf-input-list mb-4'>
                        <div class='text-right col-12 mb-1' id='MlogInUn'></div>
                        <input type='text' class='input-value LogIN'id='logInUn' name='logInUn' placeholder='User Name*'>
                        <div class='text-right col-12 mb-1' id='MlogInPs'></div>
                        <input type='text' class='input-value LogIN'id='logInPs' name='logInPs' placeholder='Password'>
                    </div>
                    <button type='' id='LogINBtn'><span>LOG IN NOW</span></button>
                </form>
            </div>
        </div>
     </div>
    <!-- Sign in Section End -->

    <!-- Js Plugins -->
    <script src='js/jquery-3.3.1.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
    <script src='js/jquery.magnific-popup.min.js'></script>
    <script src='js/jquery.barfiller.js'></script>
    <script src='js/main.js'></script>
    <script src='js/getMovie.js'></script>
</body>
</html>

