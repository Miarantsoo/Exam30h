<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tea House - Tea Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style-connexion.css" rel="stylesheet">
</head>
<body>
<div class="register-container">
        <h2>Inscription utilisateur</h2>
        <form id="form-inscription" action="#">
            <div class="step" id="step1">
                <label for="firstName">Prénom</label>
                <input type="text" id="firstName" name="firstName" required>

                <label for="lastName">Nom de famille</label>
                <input type="text" id="lastName" name="lastName" required>

                <label for="birthdate">Date de naissance</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <button type="button" onclick="nextStep(2)">Suivant</button>

                <p>Vous avez déjà un compte? <a href="index.php">Connectez-vous ici</a></p>
            </div>

            <div class="step" id="step2" style="display: none;">

                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>

                <label for="gender">Genre</label>
                <select id="gender" name="gender" required>
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                    <option value="other">Autre</option>
                </select>

                <button type="button" onclick="beforeStep(1)">Precedent</button>
                <button type="submit">S'Inscrire</button>
            </div>
        </form>
    </div>
    <script>
        function nextStep(step) {
            // Masquer l'étape actuelle
            var currentStep = document.getElementById('step' + (step - 1));
            currentStep.style.display = 'none';

            // Afficher l'étape suivante
            var nextStep = document.getElementById('step' + step);
            nextStep.style.display = 'block';
        }
        function beforeStep(step) {
            // Masquer l'étape actuelle
            var currentStep = document.getElementById('step' + (step + 1));
            currentStep.style.display = 'none';

            // Afficher l'étape suivante
            var beforeStep = document.getElementById('step' + step);
            beforeStep.style.display = 'block';
        }
    </script>
</body>
</html>