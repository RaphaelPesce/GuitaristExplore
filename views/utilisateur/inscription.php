<?php
// Définir le titre de la page
$title = 'GuitaristExtreme - Inscription';
?>

<div class="wrapper">
    <div class="compte">
        <h2>Inscription</h2>
        <div>
            <!-- Créer un formulaire pour l'inscription de l'utilisateur -->
            <form method="POST" enctype="multipart/form-data" action="#">
                <div><input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required></div><br>
                <div><input type="email" id="email" name="email" placeholder="Email" required></div><br>
                <div><input type="password" id="mdp_user" name="mdp_user" placeholder="Mot de passe" required></div><br>
                <div><button type="submit" class="button bgBlue textWhite" name="envoyer">Envoyer</button></div>
            </form>
            <div class="message-container">
                <div class="greenMessage"><?php echo $messageSuccess; ?></div>
                <div class="redMessage"><?php echo $messagePseudoAndEmail; ?></div>
                <div class="redMessage"><?php echo $messageEmail; ?></div>
                <div class="redMessage"><?php echo $messagePseudo; ?></div>
            </div>
        </div>
    </div>
</div>