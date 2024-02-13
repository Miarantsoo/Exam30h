<?php
    include_once("../../inc/fonction.php");

    if (isset($_POST["id"]) && $_POST["id"] != "") {
        $id = $_POST["id"];
        $nomCueilleur = $_POST["name"];
        $genre = $_POST["genre"];
        $dateNaissance = $_POST["date"];
        $values = [$nomCueilleur, $genre, $dateNaissance];

        updateTable("leaf_cueilleur", $id, $values);
    } else if (isset($_POST["name"])) {
        $nomCueilleur = $_POST["name"];
        $genre = $_POST["genre"];
        $dateNaissance = $_POST["date"];
        $values = [$nomCueilleur, $genre, $dateNaissance];

        echo "tay";
        insertIntoTable("leaf_cueilleur", $values);

    } else if(isset($_GET["id"])){
        deleteFromTable("leaf_cueilleur", $_GET["id"]);
    }else {
        $result = selectFromTable("v_leaf_cueilleur");
        echo json_encode($result);
    }
    

?>