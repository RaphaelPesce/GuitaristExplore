<?php
$title = 'GuitaristExtreme - Formulaire Ajout Materiel';
?>

<div class="wrapper">
    <div class="actionUser">
        <div class="textCenter">
            <h1>Ajouter un matériel</h1>
            <div class="form-half">
                <h2>Matériel déjà existant</h2>
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div><label for="nom">Choisir un guitariste :</label><br></div>
                    <div>
                        <select id="guitaristeSelect" name="id_guitariste" required>
                            <?php foreach ($idGuitaristeByUser as $guitariste) : ?>
                                <option value="<?php echo $guitariste->id_guitariste; ?>">
                                    <?php echo $guitariste->nom; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="radio-container">
                        <input type="radio" id="categorieGuitare" name="categorie" value="Guitare" checked>
                        <label for="categorieGuitare">Guitare</label>

                        <input type="radio" id="categorieAmplificateur" name="categorie" value="Amplificateur">
                        <label for="categorieAmplificateur">Amplificateur</label>

                        <input type="radio" id="categorieEffet" name="categorie" value="Effet">
                        <label for="categorieEffet">Effet</label>
                    </div>
                    <div id="guitareSelectDiv" style="display: block;">
                        <label for="guitareSelect">Choisir une guitare :</label><br>
                        <select id="guitareSelect" name="nom_materiel"></select>
                    </div>
                    <div id="amplificateurSelectDiv" style="display: none;">
                        <label for="amplificateurSelect">Choisir un amplificateur :</label><br>
                        <select id="amplificateurSelect" name="nom_materiel"></select>
                    </div>
                    <div id="effetSelectDiv" style="display: none;">
                        <label for="effetSelect">Choisir un effet :</label><br>
                        <select id="effetSelect" name="nom_materiel"></select>
                    </div>
                    <input type="hidden" id="id_materiel" name="id_materiel">
                    <button type="submit" class="button bgBlue textWhite" name="ajouter">Ajouter</button>
                </form>
            </div>
            <div class="form-half">
                <h2>Nouveau Matériel</h2>
                <form action="../public/index.php?controller=materiel&action=addNewMateriel" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="id_guitariste_new_material" name="id_guitariste">
                    <div class="form-group">
                        <label for="nom_materiel">Nom du Matériel :</label>
                        <input type="text" id="nom_materiel" name="nom_materiel" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="img_mtr">Image du Matériel :</label>
                        <input type="file" id="img_mtr" name="img_mtr" required>
                    </div>
                    <input type="hidden" id="categorie_new_material" name="categorie">
                    <button type="submit" class="button bgBlue textWhite" name="ajouterNew">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>