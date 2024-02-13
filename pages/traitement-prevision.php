<?php
    include("../inc/fonction.php");
    $date = $_POST['date'];

    $poidsTotal = previsionPoidsTotalRestant($date);
    $montant = previsionPrixDeVente($date);
    echo($poidsTotal."//".$montant);
?>