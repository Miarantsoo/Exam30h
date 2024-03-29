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
                        <a href="acceuil-admin.php" class="nav-item nav-link active">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages Insertion</a>
                            <div class="dropdown-menu bg-light rounded-0 m-0">
                                <a href="insert-variete.php" class="dropdown-item">Variete</a>
                                <a href="insert-parcelle.php" class="dropdown-item">Parcelle</a>
                                <a href="insert-cueilleur.php" class="dropdown-item">Cueilleur</a>
                                <a href="insert-categorie.php" class="dropdown-item">Categorie de depenses</a>
                                <a href="insert-salaire-cueilleur.php" class="dropdown-item">Salaire Cueilleur</a>
                            </div>
                        </div>
                        <a href="configuration-saison.php" class="nav-item nav-link">Configuration saison</a>
                    </div>
                    <div class="border-start ps-4">
                        <a href="" class="fas fa-times" id="icon"></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4  slideInDown">Configuration Saison</h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>

    <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h1 class="display-6">Choisir les Mois de la Saison du Thé</h1>
    </div>

    <div class="container mt-5">
        <div  class="divcheckbox">
            <form id="" action="traitement-Mois-Regeneration.php" method="post">
                <div class="row mt-4 boxinitial d-flex flex-column">
                    <div class="col-md-6">
                        <div class="box d-flex flex-row justify-content-around gap-3">
                            <label> Janvier<input type="checkbox" name="mois[]" value="1"></label><br>
                            <label> Février<input type="checkbox" name="mois[]" value="2"></label><br>
                            <label> Mars<input type="checkbox" name="mois[]" value="3"></label><br>
                            <label> Avril<input type="checkbox" name="mois[]" value="4"></label><br>
                            <label> Mai<input type="checkbox" name="mois[]" value="5"></label><br>
                            <label> Juin<input type="checkbox" name="mois[]" value="6"></label><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box d-flex flex-row justify-content-around gap-3" >
                            <label> Juillet<input type="checkbox" name="mois[]" value="7"></label><br>
                            <label> Août<input type="checkbox" name="mois[]" value="8"></label><br>
                            <label> Septembre<input type="checkbox" name="mois[]" value="9"></label><br>
                            <label> Octobre<input type="checkbox" name="mois[]" value="10"></label><br>
                            <label> Novembre<input type="checkbox" name="mois[]" value="11"></label><br>
                            <label> Décembre<input type="checkbox" name="mois[]" value="12"></label><br>
                        </div>
                    </div>
                </div>
                <button type="submit">Valider</button>
            </form>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
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
</body>
</html>