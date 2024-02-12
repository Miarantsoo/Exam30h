<?php

    include_once("connection.php");

    function findAllUsers(){
        $res = array();
        $con = PDOConnect();
        $stmt = $con->query("SELECT * FROM users");
        while ( $tab = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $tab;
        }
        $con = null;
        return $res;
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