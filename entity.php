<?php require_once("inc/header.php"); ?>
<?php
    if(!isset($_GET["id"])) {
        ErrorMessage::show("No ID passed into page");
    }

    $entityId = $_GET["id"];
    $entity = new Entity($con, $entityId);

    $preview = new PreviewProvider($con, $userLoggedIn);
    echo $preview->createPreviewVideo($entity);
    //echo"<div style='color:white;'>";print_r($entity->getSeasons()[0]->videos[0]);echo"</div>";
    $seasonProvider = new SeasonProvider($con, $userLoggedIn);
    echo $seasonProvider->create($entity);
    /**/
    $categoryContainers = new CategoryContainers($con, $userLoggedIn);
    echo $categoryContainers->showCategory($entity->getCategoryId(), "You might also like");
?>
<?php require_once("inc/footer.php"); ?>