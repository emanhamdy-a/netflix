    <?php require_once("inc/header.php"); ?>
    <?php 
        $preview = new PreviewProvider($con,$userLoggedIn);
        echo $preview->createPreviewVideo(null);
        $container = new CategoryContainers($con,$userLoggedIn);
        echo $container->showAllCategoreis();
    ?>
    <?php require_once("inc/footer.php"); ?>