<?php
if($_POST['ilid']){
    require_once("front-end/connect_front/DBControllerf.php");
    require_once("front-end/connect_front/IlceControllerf.php");
    $ilcecont = new IlceControllerf();
    $ilceler = $ilcecont->ilcebul($_POST['ilid']);
    echo json_encode($ilceler);
}
else{
    exit;
}
?>

