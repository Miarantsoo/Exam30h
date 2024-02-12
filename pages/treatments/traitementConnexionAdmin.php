<?php
    session_start();
    include_once("../../inc/fonction.php");

    $email = $_POST["email"];
    $mdp = $_POST["password"];

    sleep(1.5);

    $verif = validationInput($email, $mdp);

    if ($verif == 0) {
        $admin = verificationAdmin($email, $mdp);
        if (!empty($admin)) {
            $_SESSION["admin"] = $admin->nom;
            echo json_encode("Mety");
        } else {
            echo json_encode("Identifiants incorrects!");
            session_destroy();
        }
    } else {
        echo $verif;
        session_destroy();
    }
    
?>