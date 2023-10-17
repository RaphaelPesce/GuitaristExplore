<?php
$title = 'GuitaristExtreme - Formulaire Ajout Guitariste';
?>

<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">

            <div>
                <?php if (!empty($message)) : ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php endif; ?>
            </div>

            <h1>Ajouter un guitariste</h1>

            <form action="#" method="POST" enctype="multipart/form-data">
                <!-- Champs pour le guitariste -->
                <div>
                    <div><label for="nom">Nom du guitariste :</label><br></div>
                    <input type="text" id="nom" name="nom" required>
                </div>

                <div>
                    <div><label for="bio">Biographie :</label><br></div>
                    <textarea id="bio" name="bio" required></textarea>
                </div>

                <div>
                    <div><label for="img_gtr">Image du guitariste :</label></div>
                    <input type="file" id="img_gtr" name="img_gtr" required>
                </div>

                <!-- Champs pour les images supplémentaires -->
                <h2>Images supplémentaires</h2>
                <div>
                    <div><label for="image_1">Image 1 :</label></div>
                    <input type="file" id="image_1" name="image_1" required>
                </div>

                <div>
                    <div><label for="image_2">Image 2 :</label></div>
                    <input type="file" id="image_2" name="image_2" required>
                </div>
                <div>
                    <div><label for="image_3">Image 3 :</label></div>
                    <input type="file" id="image_3" name="image_3" required>
                </div>
                <button type="submit" class="button bgBlue textWhite" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>
</div>