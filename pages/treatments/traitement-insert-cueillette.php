<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["data"])) {
        $dateCueillette = $_POST["date"];
        $choix = $_POST["choix-cueilleur"];
        $poids = $_POST["poids"];
        $poids = $_POST["poids"];
        $values = [$dateCueillette, $choix, $parcelle,  $poids];
    
        insertIntoTable("leaf_cueillette", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_cueillette", $_GET["id"]);
    }
    

?>