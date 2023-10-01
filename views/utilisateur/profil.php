<?php
// On définit le titre de la page
$title = 'GuitaristExtreme - Profil';
?>

<div class="wrapper">
    <div class="textCenter">
        <h1>Votre page profil</h1>
        <div>
            <!-- Affiche un message de bienvenue à l'utilisateur avec son pseudo -->
            <p>Heureux de vous revoir, <strong><?php echo $infoUtilisateur[0]->pseudo; ?></strong> !</p>
        </div>
    </div>
    <div class="profilContainer1">
        <div class="avatarContainer">
            <!-- Si l'utilisateur a un avatar, affiche l'avatar, sinon, affiche une image par défaut -->
            <?php if (!empty($_SESSION['avatar'])) : ?>
                <div class=" bgLightGrey imgAvatar">
                    <img class="#" src="<?php echo $_SESSION['avatar']; ?>" alt="avatar utilisateur">
                </div>
            <?php else : ?>
                <div class="bgLightGrey imgAvatar">
                    <img class="#" src="../public/images/upload/Mon_Compte.png" alt="avatar utilisateur">
                </div>
            <?php endif; ?>

            <div>
                <i>(Max : 600px sur 600px)</i>
            </div>

            <!-- Formulaire pour ajouter un avatar -->
            <h2>Ajouter un avatar : </h2>
            <div class="avatar">
                <form action="../public/index.php?controller=utilisateur&action=profil" method="POST" enctype="multipart/form-data">
                    <div><input class="file-input" type="file" id="avatar" name="avatar"></div>
                    <div><button class="file-button" type="submit" name="ajouter">Ajouter</button></div>
                </form>
            </div>
        </div>

        <!-- Affiche les informations de l'utilisateur -->
        <div class=infoUser>
            <div>
                <h2>Vos informations :</h2>
            </div>
            <div>
                <!-- Affiche l'adresse e-mail de l'utilisateur -->
                <h3>Adresse e-mail :<h3>
                        <i><?php echo $infoUtilisateur[0]->email; ?></i>
            </div>
            <div>
                <h3>Commentaires et notes :</h3>
            </div>
            <div>
                <!-- Affiche le nombre de commentaires et de notes de l'utilisateur -->
                <p>Nombre de commentaires : <?php echo $nbCommentaires; ?></p>
                <p>Nombre de notes : <?php echo $nbNotes; ?></p>
            </div>
            <div>
                <h3>Guitaristes associés :</h3>
            </div>
            <div>
                <!-- Si l'utilisateur n'a pas de guitariste associé à son compte, affiche un message -->
                <!-- Sinon, affiche la liste des guitaristes associés à l'utilisateur -->
                <?php if (empty($idGuitaristeByUser)) : ?>
                    <p>Il n'y a pas de guitariste associé à votre compte.</p>
                <?php else : ?>
                    <div>
                        <select id="guitaristeSelect">
                            <!-- Boucle à travers chaque guitariste associé à l'utilisateur -->
                            <?php foreach ($idGuitaristeByUser as $guitariste) : ?>
                                <option value="<?php echo $guitariste->id_guitariste; ?>"><?php echo $guitariste->nom; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- Affiche des liens pour mettre à jour le guitariste, le matériel et le réglage -->
                        <button id="updateGuitaristeButton" class="upFiche">Mise à jour Guitariste</button>
                        <button id="updateMaterielButton" class="upFiche">Mise à jour Materiel</button>
                        <button id="updateReglageButton" class="upFiche">Mise à jour Reglage</button>
                    </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<div class="profilContainer2">
    <h3>A vous de jouer ! : </h3>
    <div class="postUser">
        <!-- Affiche les liens pour ajouter un guitariste, du matériel, un réglage et un avis -->
        <a href="../public/index.php?controller=guitariste&action=addGuitariste"><button class="addButton">Ajout Guitariste</button>
        </a>
        <a href="../public/index.php?controller=materiel&action=addMateriel"><button class="addButton">Ajout Materiel</button>
        </a>
        <a href="../public/index.php?controller=reglage&action=addReglage"><button class="addButton">Ajout reglage</button>
        </a>
        <a href="../public/index.php?controller=avis&action=addAvis"><button class="addButton">Notes et Commentaires</button></a>
    </div>
</div>
</div>