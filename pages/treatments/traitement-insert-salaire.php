<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $nomCueilleur = $_POST["namecueilleur"];
        $salaire = $_POST["salaire"];
        $values = [$nomCueilleur, $salaire];

        updateTable("leaf_salairecueilleur", $id, $values);
    } else if (isset($_POST["salaire"])) {
        $nomCueilleur = $_POST["namecueilleur"];
        $salaire = $_POST["salaire"];
        $values = [$nomCueilleur, $salaire];
    
        insertIntoTable("leaf_salairecueilleur", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_salairecueilleur", $_GET["id"]);
    }else {
        $result = selectFromTable("v_leaf_selairecueilleur");
        echo json_encode($result);
    }
    

?>