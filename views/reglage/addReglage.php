<?php
$title = 'GuitaristExtreme - Formulaire Ajout Réglage';
?>

<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">
            <h1>Ajouter un réglage</h1>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div><label for="nom">Choisir un guitariste :</label><br></div>
                <div>
                    <select id="guitaristeSelect" name="id_guitariste" required><?php foreach ($idGuitaristeByUser as $guitariste) : ?>
                            <option value="<?php echo $guitariste->id_guitariste; ?>">
                                <?php echo $guitariste->nom; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div><label for="nom">Choisir un équipement :</label><br></div>
                <div>
                    <select id="equipementSelect" name="nom_materiel" required></select>
                </div>
                <div class="form-group">
                    <label for="description">Réglages :</label><br>
                    <textarea id="description" name="tonalite" required></textarea>
                </div>
                <div id="reglageMessage" style="display:none;"></div>
                <input type="hidden" id="id_materielReglage" name="id_materiel">
                <button type="submit" class="button bgBlue textWhite" name="ajouterReglage">Ajouter</button>
            </form>
        </div>
    </div>
</div>