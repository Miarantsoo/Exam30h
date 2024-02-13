<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $categorie = $_POST["categorie"];
        $values = [$categorie];

        updateTable("leaf_categoriedepense", $id, $values);
    } else if (isset($_POST["categorie"])) {
        $categorie = $_POST["categorie"];
        $values = [$categorie];
        insertIntoTable("leaf_categoriedepense", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_categoriedepense", $_GET["id"]);
    }else {
        $result = selectFromTable("leaf_categoriedepense");
        echo json_encode($result);
    }
    

?>