<?php
    include_once("../inc/fonction.php");
    if(isset($_POST['mois'])){
        $values = array();

        $checkBoxValue = $_POST['mois'];
        foreach($checkBoxValue as $value){
            $values[] = $value;
            echo $value;
        }

        // insertIntoMoisRegeneration($values);
    }
?>