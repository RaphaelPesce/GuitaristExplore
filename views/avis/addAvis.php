<?php
// Définition du titre de la page
$title = 'GuitaristExtreme - Formulaire Ajout Notes et Commentaires';
?>


<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">

            <!-- Bloc pour afficher un message, si un message est présent -->
            <div>
                <?php if (!empty($message)) : ?>
                    <!-- Affiche le message à l'utilisateur -->
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>
            </div>
            <h2>Ajouter une note et un commentaire</h2>
            <!-- Lorsque le formulaire est soumis, il envoie une demande POST à la page 'addAvis' du contrôleur 'avis' -->
            <form action="../public/index.php?controller=avis&action=addAvis" method="POST">

                <div>
                    <div><label for="guitariste">Choisir un guitariste :</label><br></div>
                    <!-- Sélecteur de guitariste. Les options sont générées dynamiquement à partir de la liste des guitaristes ($listGuitariste) -->
                    <select id="guitariste" name="id_guitariste">
                        <?php foreach ($listGuitariste as $guitariste) : ?>
                            <!-- Chaque option a comme valeur l'id du guitariste et affiche le nom du guitariste comme texte de l'option -->
                            <option value="<?php echo $guitariste->id_guitariste; ?>">
                                <?php echo $guitariste->nom; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <div><label for="note">Donner une note :</label><br></div>
                    <!-- Input pour la note qui doit être un nombre entre 0 et 10 -->
                    <input type="number" id="note" name="note" min="0" max="10" required>
                </div>
                <div>
                    <div><label for="commentaire">Déposer un commentaire :</label><br></div>
                    <textarea id="commentaire" name="commentaire" required></textarea>
                </div>
                <button type="submit" class="button bgBlue textWhite" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>
</div>