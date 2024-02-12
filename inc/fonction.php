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
        $colonnes = array();
        $con = PDOConnect();

        $statement = $con->prepare("Show columns from $table");
        $statement->execute();
        while($tab = $statement->fetch(PDO::FETCH_OBJ)){
            $colonnes[] = $tab->Field;
        }

        $con = null;
        return $colonnes;
    }

    function typeColonnesTable ($table){
        $type = array();
        $con = PDOConnect();

        $statement = $con->prepare("Show columns from $table");
        $statement->execute();
        while($tab = $statement->fetch(PDO::FETCH_OBJ)){
            $type[] = $tab->Type;
        }

        $con = null;
        return $type;
    }

    function insertIntoTable($table , $donnees){
        $colonnes = colonnesTable($table);
        $type = typeColonnesTable($table);

        $requete = "insert into $table (";
        for($i=0 ; $i<count($colonnes) ; $i++){
            $requete .= $colonnes[$i];
            if($i<count($colonnes)-1){
                $requete .= ", ";
            }
        }
        $requete .= ") values (null, ";

        for($i=0 ; $i<count($donnees) ; $i++){
            if(explode("(" , $type[$i+1])[0] =="varchar" || $type[$i+1] == "date"){
                $requete.="'".$donnees[$i]."'";
            }
            else{
                $requete.="".$donnees[$i];
            }
            if($i<count($donnees)-1){
                $requete .= ", ";
            }
        }
        $requete .= ")";

        $con = PDOConnect();
        $statement = $con->prepare($requete);
        $statement->execute();
        $con = null;
        // echo $requete;
    }

    function deleteFromTable ($table , $id){
        $colonnes = colonnesTable($table);

        $requete = "delete from $table where $colonnes[0] = $id";

        $con = PDOConnect();
        $statement = $con->prepare($requete);
        $statement->execute();
        $con = null;
        // echo $requete;
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