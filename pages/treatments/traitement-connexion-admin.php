<?php
    session_start();
    include_once("../../inc/fonction.php");

    $email = $_POST["email"];
    $mdp = $_POST["password"];

    $type = 0;
    if (isset($_POST["simpleUser"])) {
        $type++;
    }

    sleep(1.5);

    $verif = validationInput($email, $mdp);

    if ($verif == 0) {
        if ($type != 0) {
            $user = verificationUser($email, $mdp);
            if (!empty($user)) {
                $_SESSION["user"] = $user->nom;
                echo json_encode("Mety");
            } else {
                echo json_encode("Identifiants incorrects!");
                session_destroy();
            }
        } else {
            $admin = verificationAdmin($email, $mdp);
            if (!empty($admin)) {
                $_SESSION["admin"] = $admin->nom;
                echo json_encode("Mety");
            } else {
                echo json_encode("Identifiants incorrects!");
                session_destroy();
            }
        }
        
    } else {
        echo $verif;
        session_destroy();
    }
    
?>