<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Encodage des caractères -->
    <meta charset="UTF-8">
    <!-- Assure une bonne compatibilité avec les différentes versions de IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Assure que le site sera responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre du site -->
    <title><?= $title ?></title>
    <!-- Favicon du site -->
    <link rel="icon" href="../public/images/faveIcon.ico" type="image/x-icon">
    <!-- Fichier CSS principal -->
    <link rel="stylesheet" href="../public/styles/style.css">
    <!-- Chargement des polices Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
    <!-- Chargement de FontAwesome pour les icônes -->
    <script src="https://kit.fontawesome.com/fd88f2328b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- En-tête du site -->
    <header class="bgBlue">
        <!-- Logo du site, lien vers l'accueil -->
        <a href="../public/index.php?controller=home&action=index"><img id="logoSite" src="../public/images/logoSite.png" alt="Logo du site"></a>

        <!-- Vérification si l'utilisateur est connecté -->
        <?php if (isset($_SESSION['id_utilisateur'])) : ?>
            <!-- Si connecté, afficher le pseudo de l'utilisateur et le lien vers le profil et la déconnexion -->
            <div>
                <a class="textWhite" href="../public/index.php?controller=utilisateur&action=profil">
                    <i class="fa-solid fa-user textBrown"></i>Bonjour <?php echo $_SESSION['pseudo']; ?> <i id="profil">(voir profil)</i></a>
                <a class="textWhite" href="../public/index.php?controller=utilisateur&action=deconnexion">Déconnexion</a>
            </div>

            <!-- Si l'utilisateur n'est pas connecté, afficher le lien vers la page de connexion -->
        <?php else : ?>
            <a class="textWhite" href="../public/index.php?controller=utilisateur&action=connexion">
                <i class="fa-solid fa-user textBrown"></i>Connexion</a>
        <?php endif; ?>
    </header>

    <!-- Navigation du site -->
    <nav class="bgBlue">
        <!-- Menu pour le desktop -->
        <div class="desktop-menu">
            <!-- Les liens vers les différentes sections du site -->
            <ul>
                <!-- Remarque : Les liens sont construits en utilisant la convention du contrôleur et de l'action pour indiquer la page à charger. -->
                <li><a href="../public/index.php?controller=home&action=index">Accueil</a></li>
                <li><a href="../public/index.php?controller=home&action=charte">Charte</a></li>
                <li><a href="../public/index.php?controller=guitariste&action=listeGuitariste">Liste guitaristes</a></li>
                <li><a href="../public/index.php?controller=guitariste&action=classement">Classement</a></li>
            </ul>
        </div>
        <!-- Bouton pour ouvrir le menu latéral sur mobile -->
        <button class="burger-icon textBrown">&#9776;</button>
        <!-- Menu latéral pour mobile -->
        <div class="sidebar bgBlue">
            <!-- Les mêmes liens que le menu desktop -->
            <ul>
                <li><a href="../public/index.php?controller=home&action=index">Accueil</a></li>
                <li><a href="../public/index.php?controller=home&action=charte">Charte</a></li>
                <li><a href="../public/index.php?controller=guitariste&action=listeGuitariste">Liste guitaristes</a></li>
                <li><a href="../public/index.php?controller=guitariste&action=classement">Classement</a></li>
            </ul>
        </div>
    </nav>

    <!-- Section principale du site -->
    <main>
        <!-- Ici, le contenu de chaque page sera injecté dynamiquement -->
        <?php
        echo $content
        ?>
    </main>

    <!-- Pied de page du site -->
    <div class="bgBlue">
        <footer>
            <!-- Liens utiles -->
            <div class="footer-left">
                <h4>Liens utiles:</h4>
                <ul>
                    <li><a href="https://guitar.com/" target="_blank">www.guitar.com</a></li>
                    <li><a href="https://www.gilmourish.com/" target="_blank">www.gilmourish.com</a></li>
                    <li><a href="https://equipboard.com/" target="_blank">www.equipboard.com</a></li>
                    <li><a href="https://musicstrive.com/" target="_blank">www.musicstrive.com</a></li>
                </ul>
            </div>
            <!-- Droits d'auteur -->
            <div class="footer-center">
                <h4 id="copyright">
                    <?php
                    $year = date('Y');
                    echo "Copyright © $year GuitaristExplore";
                    ?>
                </h4>
            </div>
            <!-- Liens vers les réseaux sociaux -->
            <div class="footer-right">
                <h4>Suivez-nous:</h4>
                <div>
                    <a href="https://fr-fr.facebook.com/" target="_blank"><i class="fa-brands fa-facebook textBrown"></i></a>
                    <a href="https://twitter.com/?lang=fr" target="_blank"><i class="fa-brands fa-twitter textBrown "></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-square-instagram textBrown"></i></a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Chargement du script JavaScript pour le fonctionnement de certaines fonctionnalités -->
    <script src="../public/scripts/script.js"></script>
    <script src="../public/scripts/fetchAPI.js"></script>
</body>

</html>