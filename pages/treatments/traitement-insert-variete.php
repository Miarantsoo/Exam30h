<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $nomVariete = $_POST["variete"];
        $occupation = $_POST["occupation"];
        $rendement = $_POST["rendement"];
        $prixVente = $_POST["prix-vente"];
        $values = [$nomVariete, $occupation, $rendement, $prixVente];

        updateTable("leaf_variete", $id, $values);
    } else if (isset($_POST["variete"])) {
        $nomVariete = $_POST["variete"];
        $occupation = $_POST["occupation"];
        $rendement = $_POST["rendement"];
        $prixVente = $_POST["prix-vente"];
        $values = [$nomVariete, $occupation, $rendement, $prixVente];
    
        insertIntoTable("leaf_variete", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_variete", $_GET["id"]);
    }else {
        $result = selectFromTable("leaf_variete");
        echo json_encode($result);
    }
    

?>