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

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-connexion.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Connexion Utilisateur</h2>
        <form id="form-admin">
            <input type="hidden" name="simpleUser" value="0">
            <label for="username">E-mail</label>
            <input type="email" id="username" name="email" value="miarantsoa@itu.mg" required>
            
            <label for="password">Mot de passe: miarantsoa27</label>

            <input type="password" id="password" name="password" value="miarantsoa27" required>

            <button type="submit" id="connect-admin">Se Connecter</button>

            <p><a href="connexion-admin.php">Se connecter en tant qu'admin</a></p>
            <p> Pas encore de compte ?<a href="inscription.php">Créer ici</a></p>
        </form>
    </div>
    <script type="module" src="../assets/js/script.js"></script>
</body>
</html>