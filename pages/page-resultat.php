<?php
    $cueillette = 0;
    $restant = 0;
    $vente = 0;
    $depense = 0;
    $benefice = 0;
    $revient = 0;
    if(isset($_GET['resultat'])){
        // $ensemble = $cueillette.".".$restant.".".$depense.".".$revient;
        $ensemble = explode("//" , $_GET['resultat']);

        $cueillette = $ensemble[0];
        $restant = $ensemble[1];
        $vente = $ensemble[2];
        $depense = $ensemble[3];
        $revient = $ensemble[4];
        $benefice = $vente-$depense;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Leaf</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-insert.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid bg-white sticky-top" style="top: -150px;">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <!-- <a href="index.html" class="navbar-brand">
                    <img class="img-fluid" src="../assets/img/logo.png" alt="Logo">
                </a> -->
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="acceuil-utilisateur.php" class="nav-item nav-link active">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages de saisie</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="saisie-cueillette.php" class="dropdown-item">Cueillettes</a>
                                <a href="saisie-depense.php" class="dropdown-item">Depenses</a>
                            </div>
                        </div>
                        <a href="page-resultat.php" class="nav-item nav-link">Resultat</a>
                        <a href="liste-paiement.php" class="nav-item nav-link">Liste paiement cueilleur</a>
                        <a href="page-prevision.php" class="nav-item nav-link">Prevision</a>
                    </div>
                    <div class="border-start ps-4">
                        <a href="disconnect.php" class="fas fa-times" id="icon"></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="border-top mb-4"></div>

    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4  slideInDown">Resultat Recolte</h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="form-insert">
        <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
          <h1 class="display-6">Affiche Resultat</h1>
            </div>
            <form action="traitement-dateDebut-dateFin.php" class="mt-4" method="post">
                <div class="mb-3">
                <label for="Date">Date début</label>
                <input type="date" id="" name="date-debut"required>
            </div>

            <div class="mb-3">
                <label for="Date">Date fin</label>
                <input type="date" id="" name="date-fin"required>
            </div>
            <button type="submit">Valider</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="border-top mb-4"></div>

<div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
          <h1 class="display-6">Résultats de la Récolte</h1>
            </div>

<div class="container mt-5">

  <div class="container mt-5">
  <div class="row mt-4">
    <div class="col-md-4">
      <h2>Global</h2>
      <p>Poids total de la cueillette: <h4 id="poid-total"><?php echo $cueillette;?> Kg</h4></p>
    </div>
    <div class="col-md-4">
      <h2>&nbsp;</h2> <!-- Ajoutez une colonne vide pour l'espace -->
      <p>Poids restant sur les parcelles à la date de fin: <h4 id="poid-restant"><?php echo $restant;?> Kg</h4></p>
    </div>
    <div class="col-md-4">
      <h2>&nbsp;</h2> <!-- Ajoutez une colonne vide pour l'espace -->
      <p>Montant des ventes: <h4 id="montant-vente"><?php echo $vente;?> $</h4></p>
    </div>
    <div class="col-md-4">
      <p>Montant des dépenses: <h4 id="montant-depense"><?php echo $depense;?> $</h4></p>
    </div>
    <div class="col-md-4">
      <p>Bénéfice: <h4 id="benefice"><?php echo $benefice;?> $</h4></p>
    </div>
    <div class="col-md-4">
      <p>Coût de revient par kg: <h4 id="cout-revient"><?php echo $revient;?> $</h4></p>
    </div>
  </div>
</div>
</div>

    <footer>
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                    © Miarantsoa ETU 002779 - Tsinjo ETU 002362 - Nekena ETU 002669
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>
</html>