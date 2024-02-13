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

    function insertIntoMoisRegeneration ($mois){
        $requete = "insert into leaf_regeneration values ";
        for($i=0 ; $i<count($mois) ; $i++){
            $requete .= "('2024-".$mois[$i]."-01')";
            if($i<count($mois)-1){
                $requete .= ",";
            }
        }
        $con = PDOConnect();
        $statement = $con->prepare($requete);
        $statement->execute();
        $con = null;
    }

    function debutMoisDeRegeneration ($debut , $fin){
        $requete = "select * from leaf_regeneration where dateRegeneration>='$debut' and dateRegeneration <= '$fin'";
        $con = PDOConnect();

        $stmt = $con->query($requete);
        $val = $debut;
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val = $tab->dateRegeneration; 
        }

        $con = null;
        // echo $val;
        return $val;
    }

    function poidTotalCueillette ($debut , $fin){
        $val = 0;
        // $debut = debutMoisDeRegeneration ($debut , $fin);
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

    function poidRestantParcelles($debut , $fin){
        $somme = 0;

        // $debut = debutMoisDeRegeneration ($debut , $fin);

        $requete = "select * from v_leaf_poidRestantPercelle where dateCueillette>='$debut' and dateCueillette<='$fin' group by numeroParcelle limit 1";
        
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

    function montantDepense ($debut , $fin){
        $val = 0;
        // $debut = debutMoisDeRegeneration ($debut , $fin);
        $requete = "select sum(montant) as somme from leaf_depense where dateDepense>='$debut' and dateDepense<='$fin'";

        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }

        /*$requete = "select sum(montant) as somme from leaf_salaireCueilleur";
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }*/

        // $poid = poidTotalCueillette($debut , $fin);

        // $val = $val/$poid;

        // echo $val;
        return $val;
    }

    function coutRevient ($debut , $fin){
        $val = 0;
        // $debut = debutMoisDeRegeneration ($debut , $fin);
        $requete = "select sum(montant) as somme from leaf_depense where dateDepense>='$debut' and dateDepense<='$fin'";

        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }

        $requete = "select sum(montant) as somme from leaf_salaireCueilleur";
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->somme; 
        }

        $poid = poidTotalCueillette($debut , $fin);

        $val = $val/$poid;

        // echo $val;
        return $val;
    }

    function paiements ($debut , $fin){
        // $debut = debutMoisDeRegeneration ($debut , $fin);
        $cueilleur = array();

        $date1 = new DateTime($debut);
        $date2 = new DateTime($fin);

        $intervale = $date1->diff($date2);
        $nbjour = $intervale->days;

        $ind = 0;

        $requete = "select * from v_leaf_paiementCueilleur where dateCueillette>='$debut' and dateCueillette<='$fin' group by idCueilleur";

        $con = PDOConnect();

        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $poidJournalier = $tab->poidTotal/$nbjour;
            $totalSalaire = ($tab->poidTotal*$tab->montant);
            if($poidJournalier<$tab->poidMinimal){
                $totalSalaire = $totalSalaire-($totalSalaire*($tab->mallus/100));
            }
            else if($poidJournalier>$tab->poidMinimal){
                $totalSalaire = $totalSalaire+($totalSalaire*($tab->bonus/100));
            }
            $cueilleur[] = $tab;
            $cueilleur[$ind]->paiement = $totalSalaire;
            $ind++; 
        }

        return $cueilleur;
    }

    function montantVente ($debut , $fin){
        $requete = "select * from v_leaf_vente where dateCueillette>='$debut' and dateCueillette<='$fin'";

        $con = PDOConnect();
        $stmt = $con->query($requete);
        $val = 0;
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $val += $tab->produit; 
        }

        $con = null;
        // echo $val;
        return $val;
    }

    function previsionPoidsCueilli ($date){
        $i=0;
        $max = array();
        $requete = "select max(dateCueillette)as somme from leaf_cueillette group by numeroParcelle";
        $con = PDOConnect();
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $max[] = $tab->somme; 
        }

        $intervale = 0;
        $dateComp = new DateTime($date);
        $previsionRetrait = array();

        $requete = "select datediff(max(dateCueillette),min(dateCueillette)) as differenceJour , sum(poidCueilli) as sommeCueilli from leaf_cueillette group by numeroParcelle";
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $temp = new DateTime($max[$i]);
            $intervale = $dateComp->diff($temp)->days;
            $cueilli = ($tab->sommeCueilli/$tab->differenceJour)*$intervale;
            $previsionRetrait[] = ($tab->sommCueilli)+$cueilli;
            $i++; 
        }

        return $previsionRetrait;
    }

    function previsionPoidsRestant ($date){
        $i=0;
        $reste = array();
        $poidsCueilli = previsionPoidsCueilli($date);

        $requete = "select * from v_leaf_infoParcelle";
        $con = PDOConnect();
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $reste[] = ($tab->poid)-$poidsCueilli[$i];
            $i++; 
        }

        return $reste;
    }

    function previsionPoidsTotalRestant ($date){
        $somme = 0;
        $reste = previsionPoidsRestant($date);

        for($i=0 ; $i<count($reste) ; $i++){
            $somme += $reste[$i];
        }

        return $somme;
    }

    function previsionPrixDeVente($date){
        $i=0;
        $somme=0;
        $reste = previsionPoidsCueilli($date);

        $requete = "select leaf_parcelle.numeroParcelle , leaf_variete.prixDeVente from leaf_parcelle join leaf_variete on leaf_parcelle.idVariete = leaf_variete.idVariete";
        $con = PDOConnect();
        $stmt = $con->query($requete);
        while($tab = $stmt->fetch(PDO::FETCH_OBJ)){
            $somme += (($tab->prixDeVente)*$reste[$i]);
            $i++; 
        }
        return $somme;
    }
?>