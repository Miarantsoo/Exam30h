<?php

    function PDOConnect(){
        $user = "root";
        $pass = "";
        $url = "mysql:host=localhost;port=3306;dbname=exam30h";

        try {
            $con = new PDO($url, $user, $pass);
            return $con;
        } catch (PDOException $ex) {
            print "Erreur " . e->getMessage();
            die();
        }
    }
?>