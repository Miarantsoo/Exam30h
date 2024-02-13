<?php
    include_once("../../inc/fonction.php");

    $result = selectFromTable("leaf_genre");
    echo json_encode($result);
?>