<?php

    function PDOConnect(){
        $user = "ETU002779";
        $pass = "VUzAztrT5xms";
        $url = "mysql:host=172.10.0.113;port=3306;dbname=db_p16_ETU002779";

        try {
            $con = new PDO($url, $user, $pass);
            return $con;
        } catch (PDOException $ex) {
            print "Erreur " . e->getMessage();
            die();
        }
    }
?>