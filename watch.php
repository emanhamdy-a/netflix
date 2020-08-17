    <?php $hideNav=''; 
         require_once("inc/header.php");
    ?>
    <?php
     if(!isset($_GET["id"])) {
        ErrorMessage::show("No ID passed into page");
     }
     $user=new User($con,$userLoggedIn);
     if(!$user->getIsSubscribed()){
        ErrorMessage::show("you must be subscribed to see this <a href='profile.php'>click here to subscribe</a>");
     }
     ?>
    <?php 
    $video = new Video($con, $_GET["id"]);
    $video->incrementViews();
    
    $upNextVideo = VideoProvider::getUpNext($con, $video);
    ?>

    <div class="watchContainer">
        
        <div class="videoControls watchNav">
            <button onclick="goBack()"><i class="fa fa-arrow-left"></i></button>
            <h3 style='color:white;'class='h3'><?php echo $video->getTitle(); ?></h3>
        </div>
        <div class="videoControls upNext" style="display:none;">

            <button onclick="restartVideo();"><i class='fa fa-repeat'></i></button>

            <div class="upNextContainer">
                <h2>Up next:</h2>
                <h3><?php  echo$upNextVideo->getTitle(); ?></h3>
                <h3><?php echo $upNextVideo->getSeasonAndEpisode(); ?></h3>

                <button class="playNext" onclick="watchVideo(<?php echo $upNextVideo->getId() ?>)">
                    <i class="fa fa-play"> play</i> 
                </button>
            </div>
        
        </div>
     
        <video controls autoplay onended="showUpNext()">
            <source src='<?php echo $video->getFilePath(); ?>' type="video/mp4">
        </video>
    </div>

    <?php require_once("inc/footer.php"); ?>
    <script>
        startHideTimer();
        initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
    </script>