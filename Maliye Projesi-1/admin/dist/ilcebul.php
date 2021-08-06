<?php
if($_POST['ilid']){
    require_once("../connect/DBController.php");
    require_once("../connect/IlceController.php");
    $ilcecont = new IlceController();
    $ilceler = $ilcecont->ilcebul($_POST['ilid']);
    echo json_encode($ilceler);
}
else{
    exit;
}
?>

