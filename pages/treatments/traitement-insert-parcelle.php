<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $numeroParcelle = $_POST["numero"];
        $surface = $_POST["surface"];
        $variete = $_POST["variete"];
        $values = [$numeroParcelle, $surface, $variete];

        updateTable("leaf_parcelle", $id, $values);
    } else if (isset($_POST["numero"])) {
        $numeroParcelle = $_POST["numero"];
        $surface = $_POST["surface"];
        $variete = $_POST["variete"];
        $values = [$numeroParcelle, $surface, $variete];
    
        insertIntoTable("leaf_parcelle", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_parcelle", $_GET["id"]);
    }else {
        $result = selectFromTable("leaf_parcelle");
        echo json_encode($result);
    }
    

?>