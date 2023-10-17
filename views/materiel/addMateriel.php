<?php
$title = 'GuitaristExtreme - Formulaire Ajout Materiel';
?>

<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">
            <h1>Ajouter un matériel</h1>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div>
                    <div><label for="nom">Choisir un guitariste :</label><br></div>
                    <select id="nom" name="nom" required><?php foreach ($idGuitaristeByUser as $guitariste) : ?>
                            <option value="<?php echo $guitariste->id_guitariste; ?>">
                                <?php echo $guitariste->nom; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>



                </div>
                <button type="submit" class="button bgBlue textWhite" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>
</div>