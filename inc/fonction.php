<?php

    include_once("connection.php");

    function findAllUsers(){
        $res = array();
        $con = PDOConnect();
        $stmt = $con->query("SELECT * FROM leaf_users");
        while ( $tab = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $tab;
        }
        $con = null;
        return $res;
    }

    function colonnesTable ($table){
        if($table === "admin"){
            $colonnes = array("idAdmin" , "nom" , "eMail" , "motDePasse");
        }

        else if($table === "variete"){
            $colonnes = array("idVariete" , "nomVariete" , "occupation" , "rendement");
        }

        else if($table === "parcelle"){
            $colonnes = array("idParcelle" , "numeroParcelle" , "surface" , "idVariete");
        }

        else if($table === "genre"){
            $colonnes = array("idGenre" , "nom");
        }

        else if($table ==="cueilleur"){
            $colonnes = array("idCueilleur" , "nom" , "idGenre" , "dateNaissance");
        }

        else if($table === "categorieDepense"){
            $colonnes = array("idCategorie" , "categorie");
        }

        else if($table === "salaireCueilleur"){
            $colonnes = array("idSalaire" , "idCueilleur" , "montant");
        }
        return $colonnes;
    }

    function typeColonnesTable ($table){
        if($table === "admin"){
            $colonnes = array("int" , "nom" , "eMail" , "motDePasse");
        }

        else if($table === "variete"){
            $colonnes = array("idVariete" , "nomVariete" , "occupation" , "rendement");
        }

        else if($table === "parcelle"){
            $colonnes = array("idParcelle" , "numeroParcelle" , "surface" , "idVariete");
        }

        else if($table === "genre"){
            $colonnes = array("idGenre" , "nom");
        }

        else if($table ==="cueilleur"){
            $colonnes = array("idCueilleur" , "nom" , "idGenre" , "dateNaissance");
        }

        else if($table === "categorieDepense"){
            $colonnes = array("idCategorie" , "categorie");
        }

        else if($table === "salaireCueilleur"){
            $colonnes = array("idSalaire" , "idCueilleur" , "montant");
        }
        return $colonnes;
    }

    function validationInput($email , $password){
        if(empty($email) || empty($password)){
            return 0;
        }
        else if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
            return 0;
        }
        return 1;
    }

    function verificationAdmin($email , $password){
        $res = array();
        $con = PDOConnect();
        $stmt = $con->query("SELECT * FROM leaf_admin where eMail = '".$email."' and motDePasse = SHA(".$password.")");
        while ( $tab = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $tab;
        }
        $con = null;
        return $res[0];
    }

    function verification ($email , $password){
        $requete = "select * from user where eMail = :eMail and motDePasse = SHA(:password)";

        $pdo = PDOConnect();

        $statement = $pdo->prepare($requete);
        $statement->bindParam(':eMail' , $email);
        $statement->bindParam(':password' , $password);

        $statement->execute();

        $resultats = $statement->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;

        return $resultats;
    }

?>