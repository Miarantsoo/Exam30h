<?php
    session_start();
    include_once("../../inc/fonction.php");

    $email = $_POST["email"];
    $mdp = $_POST["password"];

    $verif = validationInput($email, $mdp);

    if ($verif == 0) {
        $admin = verificationAdmin($email, $mdp);
        if (!empty($admin)) {
            $_SESSION["admin"] = $admin->nom;
            header("Location:../pageAdmin.php");
        } else {
            echo json_encode("Identifiants incorrects!");
        }
    } else {
        echo $verif;
    }
    
    session_destroy();
?>