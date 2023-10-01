<?php
$title = 'GuitaristExtreme - Fiche Guitariste';
?>

<div id="banner">
    <img src="../public/images/bandeauSite.png" class="responsive-img">
</div>

<div class="wrapper">

    <article>
        <div class="textCenter">
            <h1><?php echo $guitariste->nom ?></h1>
        </div>

        <div class="ficheGtr">
            <div>
                <div class="carousel-container">
                    <div class="carousel-main">
                        <img src="<?php echo $guitariste->image_1; ?>" alt="Image 1 guitariste">
                    </div>
                    <div class="carousel-thumbnails">
                        <img src="<?php echo $guitariste->image_1; ?>" alt="Image 1 guitariste" class="active">
                        <img src="<?php echo $guitariste->image_2; ?>" alt="Image 2 guitariste">
                        <img src="<?php echo $guitariste->image_3; ?>" alt="Image 3 guitariste">
                    </div>
                </div>
            </div>

            <div class="ficheGtrBio">
                <h2>Biographie :</h2>
                <p><?php echo $guitariste->bio ?></p>
            </div>
        </div>
    </article>



    <div class="onglets">
        <div class="container-onglet">
            <button class="onglet actif">Equipements</button>
            <button class="onglet">Réglages</button>
            <button class="onglet">Notes et Commentaires</button>
        </div>

        <div class="contenair-contenu">
            <div id="contenuOnglet1" class="contenuOnglet actif">
                <?php
                foreach ($equipement as $materiel) {
                ?>
                    <section class="materiel">
                        <div>
                            <img src="<?php echo $materiel->img_mtr; ?>" alt="Image equipement Guitariste">
                        </div>
                        <div>
                            <div>
                                <h3><?php echo $materiel->nom_materiel ?></h3>
                            </div>
                            <div>
                                <p><?php echo $materiel->description ?></p>
                            </div>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>

            <div id="contenuOnglet2" class="contenuOnglet">
                <?php
                foreach ($reglages as $reglage) {
                ?>
                    <section class="reglage">
                        <div>
                            <h3><?php echo $reglage->nom_materiel; ?> :</h3>
                            <p><?php echo nl2br($reglage->tonalite); ?></p>
                        </div>
                        <div>
                            <p><?php  ?></p>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>

            <div id="contenuOnglet3" class="contenuOnglet">
                <?php
                foreach ($avis as $avisItem) {
                ?>
                    <section class="avis">
                        <div class="avisLeft">
                            <img class="bgLightGrey" src="<?php echo $avisItem->avatar; ?>" alt="Avatar de l'utilisateur">
                            <p><?php echo $avisItem->pseudo; ?></p>
                            <?php
                            $date = date_create_from_format('Y-m-d', $avisItem->date);
                            if ($date) {

                                echo '<p>Posté le : ' . $date->format('d-m-Y') . '</p>';
                            } else {
                                // Gérer l'erreur si la date ne peut pas être convertie
                                echo '<p>Date invalide</p>';
                            }
                            ?>
                        </div>
                        <div class="avisRight">
                            <p>Note de <?php echo $avisItem->note; ?>/10</p>
                            <p><?php echo $avisItem->commentaire; ?></p>
                        </div>
                    </section>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>