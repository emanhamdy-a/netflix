<?php require_once("inc/header.php"); ?>
    <?php 
        if(!isset($_GET["id"])) {
            ErrorMessage::show("No id passed to page");
        }

        $preview = new PreviewProvider($con, $userLoggedIn);
        echo $preview->createCategoryPreviewVideo($_GET["id"]);

        $containers = new CategoryContainers($con, $userLoggedIn);
        echo $containers->showCategory($_GET["id"]);
    ?>
<?php require_once("inc/footer.php"); ?>