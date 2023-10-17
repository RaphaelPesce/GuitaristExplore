<?php
$title = 'GuitaristExtreme - Formulaire Modification Guitariste';
?>

<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">

            <h1>Modification d'un guitariste</h1>

            <form action="#" method="POST" enctype="multipart/form-data">
                <!-- Champs pour le guitariste -->
                <div>
                    <input type="test" id="id_guitariste" name="id_guitariste" hidden value="<?php echo $guitariste->id_guitariste; ?>">
                </div>
                <div>
                    <div><label for="nom">Nom du guitariste :</label><br></div>
                    <input type="text" id="nom" name="nom" value="<?php echo $guitariste->nom; ?>">
                </div>

                <div>
                    <div><label for="bio">Biographie :</label><br></div>
                    <textarea id="bio" name="bio"><?php echo $guitariste->bio; ?></textarea>
                </div>

                <div>
                    <div><label for="img_gtr">Image du guitariste :</label></div>
                    <input type="file" id="img_gtr" name="img_gtr">
                </div>

                <!-- Champs pour les images supplémentaires -->
                <h2>Images supplémentaires</h2>
                <div>
                    <div><label for="image_1">Image 1 :</label></div>
                    <input type="file" id="image_1" name="image_1">
                </div>

                <div>
                    <div><label for="image_2">Image 2 :</label></div>
                    <input type="file" id="image_2" name="image_2">
                </div>
                <div>
                    <div><label for="image_3">Image 3 :</label></div>
                    <input type="file" id="image_3" name="image_3">
                </div>
                <button type="submit" class="button bgBlue textWhite" name="modifier">Modifier</button>
            </form>
        </div>
    </div>
</div>