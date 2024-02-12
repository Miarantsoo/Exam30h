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

?>