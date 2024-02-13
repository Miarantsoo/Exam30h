<?php
    include_once("../inc/fonction.php");

    $debut = $_POST['date-debut'];
    $fin = $_POST['date-fin'];

    $cueilleur = paiements ($debut , $fin);
    $objectSerialisable = urldecode(serialize($cueilleur));
    // print_r($cueilleur);
    // die();

    header("location:liste-paiement.php?cueilleur=$objectSerialisable");
?>