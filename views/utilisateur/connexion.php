<?php
$title = 'GuitaristExtreme - Connexion';
?>

<div class="wrapper">
    <div class="compte">
        <!-- Affiche le message d'erreur -->
        <h2>Connexion</h2>
        <div>
            <form method="POST" enctype="multipart/form-data" action="#">
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required><br><br>
                <input type="password" id="mdp_user" name="mdp_user" placeholder="Mot de passe" required><br><br>
                <button type="submit" class="button bgBlue textWhite" name="connecter">Connexion</button>
            </form>
            <div class="message-container">
                <div class="redMessage"><?php echo $message; ?></div>
            </div>
        </div>
        <p>Je n'ai pas encore de <strong><a class="textBrown" href="../public/index.php?controller=utilisateur&action=inscription">compte</a></strong></p>
    </div>
</div>