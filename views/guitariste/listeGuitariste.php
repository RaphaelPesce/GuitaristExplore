<?php
$title = 'GuitaristExtreme - Liste Guitaristes';
?>

<div id="banner">
    <img src="../public/images/bandeauSite.png" class="responsive-img">
</div>

<div class="wrapper">
    <div class="textCenter">
        <h1>Liste des guitaristes</h1>
    </div>

    <div class="imageContainer">
        <?php
        foreach ($listGuitariste as $guitariste) {
        ?>
            <figure class="textCenter">
                <a href="../public/index.php?controller=guitariste&action=ficheGuitariste&id=<?php echo $guitariste->id_guitariste; ?>">
                    <img src="<?php echo $guitariste->img_gtr ?>" alt="Image d'un guitariste"></a>
                <figcaption><?php echo $guitariste->nom ?></figcaption>
            </figure>
        <?php
        }
        ?>
    </div>
</div>