    <?php require_once("inc/header.php"); ?>
    <?php 
        $preview = new PreviewProvider($con,$userLoggedIn);
        echo $preview->createTVShowPreviewVideo();
        $container = new CategoryContainers($con,$userLoggedIn);
        echo $container->showTVShowCategories();
    ?>
    <?php require_once("inc/footer.php"); ?>