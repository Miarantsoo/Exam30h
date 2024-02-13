<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $dateDepense = $_POST["date"];
        $choix = $_POST["choix-depense"];
        $montant = $_POST["montant"];
        $values = [$dateDepense, $choix, $montant];

        updateTable("leaf_depense", $id, $values);
    } else if (isset($_POST["choix-depense"])) {
        $dateDepense = $_POST["date"];
        $choix = $_POST["choix-depense"];
        $montant = $_POST["montant"];
        $values = [$dateDepense, $choix, $montant];
    
        insertIntoTable("leaf_depense", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_depense", $_GET["id"]);
    }else {
        $result = selectFromTable("v_leaf_depense");
        echo json_encode($result);
    }
    

?>