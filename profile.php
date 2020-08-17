<?php
require_once("inc/header.php");
require_once("inc/lib/User.php");
require_once("inc/lib/BillingDetails.php");
$user = new User($con, $userLoggedIn);

$detailsMessage = "";
$passwordMessage = "";
$subscriptionMessage = "";

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $token = $_GET['token'];
    $agreement = new \PayPal\Api\Agreement();

    $subscriptionMessage = "<div class='alertError'>
                            Something went wrong!
                        </div>";
  
    try {
      // Execute agreement
       $agreement->execute($token, $apiContext);

        $result = BillingDetails::insertDetails($con, $agreement, $token, $userLoggedIn);
        $result = $result && $user->setIsSubscribed(1);

        if($result) {
            $subscriptionMessage = "<div class='alertSuccess'>
                            You're all signed up!
                        </div>";
        }


    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      // echo $ex->getCode();
      // echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } 
  else if (isset($_GET['success']) && $_GET['success'] == 'false') {
    $subscriptionMessage = "<div class='alertError'>
                            User cancelled or something went wrong!
                        </div>";
  }

?>

<div class="settingsContainer column">

    <div class="formSection">

        <form method="POST"id='UserUpdt'>

            <h2 id='titleUpdate'>User details</h2>
            
            <?php
           
            $firstName = $user->getFullName();
            $lastName  = $user->getUsername();
            $email     = $user->getEmail();
             /**/
            ?>

            <input class='UserUpdate' type="text"  id='fullnm'name="fullName" placeholder="First name" value="<?php  echo $firstName; ?>">
            <div class="message"id='Mfullnm'></div>
            <input class='UserUpdate' type="text"  id='usernm' name="userName" placeholder="Last name" value="<?php  echo $lastName; ?>">
            <div class="message"id='Musernm'></div>
            <input class='UserUpdate' type="email" id='email'  name="email" placeholder="Email" value="<?php  echo $email; ?>">
            <div class="message"id='Memail'></div>
            
            <input id='' type="submit" name="saveDetailsButton" value="Save">


        </form>

    </div>

    <div class="formSection">

        <form method="POST"id='UserUpdtPs'>

            <h2 id='titleUpdatePs'>Update password</h2>

            <input type="password" id='oldPassword' class='UpdatePs' name="oldPassword" placeholder="Old password">
            <div class="messagePs" id='MoldPassword'> </div>
            <input type="password" id='newPassword' class='UpdatePs' name="newPassword" placeholder="New password">
            <div class="messagePs" id='MnewPassword'> </div>
            <input type="password" id='newPassword2' class='UpdatePs' name="newPassword2" placeholder="Confirm new password">
            <div class="messagePs" id='MnewPassword2'> </div>

            <input type="submit" name="savePasswordButton" value="Save">


        </form>

    </div>

    <div class="formSection">
        <h2>Subscription</h2>

        <div class="message">
            <?php  echo $subscriptionMessage; ?>
        </div>

        <?php 
        if($user->getIsSubscribed()) {
            echo "<h3>You are subscribed! Go to PayPal to cancel.</h3>";
        }
        else {
            echo "<a href='billing.php'>Subscribe to Reeceflix</a>";
        }
        ?>
    </div>

</div>
<?php require_once("inc/footer.php"); ?>