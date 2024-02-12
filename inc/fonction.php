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
            if($colonnes[$i+1] == "motDePasse"){
                $requete.="SHA2('".$donnees[$i]."' , 256)";
            }
            else if(explode("(" , $type[$i+1])[0] =="varchar" || $type[$i+1] == "date"){
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

    function updateTable ($table , $id , $donnees){
        $colonnes = colonnesTable($table);
        $type = typeColonnesTable($table);
        $requete = "update $table set ";

        for($i=0 ; $i<count($donnees) ; $i++){
            if(explode("(" , $type[$i+1])[0] =="varchar" || $type[$i+1] == "date"){
                $requete.=$colonnes[$i+1]." = '".$donnees[$i]."'";
            }
            else{
                $requete .= $colonnes[$i+1]." = ".$donnees[$i];
            }
            if($i<count($donnees)-1){
                $requete .= ", ";
            }
        }

        $requete .= " where $colonnes[0] = $id";
        $con = PDOConnect();
        $statement = $con->prepare($requete);
        $statement->execute();
        $con = null;
        // echo $requete;
    }

    function selectFromTable ($table){
        $res = array();
        $con = PDOConnect();
        $stmt = $con->query("SELECT * FROM $table");
        while ( $tab = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $tab;
        }
        $con = null;
        return $res;
    }

    function selectFromTablePourAfficher ($table){
        $res = array();
        $con = PDOConnect();
        if($table == "leaf_parcelle" || $table == "leaf_cueilleur" || $table == "leaf_salaireCueilleur"){
            $table = "v_"+$table;
        }
        $stmt = $con->query("SELECT * FROM $table");
        while ( $tab = $stmt->fetch(PDO::FETCH_OBJ)) {
            $res[] = $tab;
        }
        $con = null;
        return $res;
    }

    function validationInput($email , $password){
        if(empty($email)){
            return "E-Mail must be given";
        }
        else if(empty($password)){
            return "Password must be given";
        }
        else if (!filter_var($email , FILTER_VALIDATE_EMAIL)){
            return "E-Mail format not valide";
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

    function poidTotalCueillette ($debut , $fin){
        $val = 0;
        $requete = "select sum(poidCueilli) as somme from leaf_cueillette where dateCueillette>='$debut' and dateCueillette<='$fin'";
        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }

        $con = null;
        // echo $val;
        return $val; 
    }

    function poidRestantParcelles($date){
        $somme = 0;
        $split  = explode("-" , $date);
        $debut = $split[0]."-".$split[1]."-"."01";
        $requete = "select * from v_leaf_poidRestantPercelle where dateCueillette>='$debut' and dateCueillette<='$date' group by numeroParcelle limit 1";
        
        $val = array();
        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $somme += $tab->difference; 
            $val[] = $tab; 
        }

        $con = null;
        // echo $somme;
        return $somme; 
    }

    function coutDeRevient ($debut , $fin){
        $val = 0;
        $requete = "select sum(montant) as somme from leaf_depense where dateDepense>='$debut' and dateDepense<='$fin'";

        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }

        $poid = poidTotalCueillette($debut , $fin);

        $val = $val/$poid;

        // echo $val;
        return $val;
    }
?>