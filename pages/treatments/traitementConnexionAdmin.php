<?php
    session_start();
    include_once("../../inc/fonction.php");

    $email = $_POST["email"];
    $mdp = $_POST["password"];

    $verif = validationInput($email, $password);

    if ($verif == 0) {
        $admin = verificationAdmin($email, $mdp);
        $_SESSION["admin"] = $admin->nom;
        header("Location:../pageAdmin.php");
    } else {
        echo $verif;
    }
    

?>