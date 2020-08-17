<?php require_once("inc/header.php"); ?>
    <?php 
        $preview = new PreviewProvider($con,$userLoggedIn);
        echo $preview->createMoviePreviewVideo();
        $container = new CategoryContainers($con,$userLoggedIn);
        echo $container->showMovieCategories();
    ?>
    <?php require_once("inc/footer.php"); ?>