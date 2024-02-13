<?php
    include_once("../inc/fonction.php");

    $debut = $_POST['date-debut'];
    $fin = $_POST['date-fin'];

    $cueillette = poidTotalCueillette ($debut , $fin);
    $restant = poidRestantParcelles($debut , $fin);
    $vente = montantVente($debut , $fin);
    $depense = montantDepense ($debut , $fin);
    $revient = coutRevient ($debut , $fin);

    $ensemble = $cueillette."//".$restant."//".$vente."//".$depense."//".$revient;

    header("location:page-resultat.php?resultat=$ensemble");
?>