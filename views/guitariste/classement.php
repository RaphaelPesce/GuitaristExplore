<?php
$title = 'GuitaristExtreme - Classement';
?>
<div id="banner">
    <img src="../public/images/bandeauSite.png" class="responsive-img">
</div>

<div class="wrapper">

    <div class="textCenter">
        <h1>Notre Top 50</h1>
    </div>

    <div class="contSeparation">
        <hr class="separation">
    </div>

    <?php
    $position = 1;
    foreach ($classement as $guitariste) {
    ?>
        <div class="itemGtr">
            <div class="position">
                <p><?php echo $position ?></p>
            </div>
            <div class="image-guitariste">
                <img src="<?php echo $guitariste->img_gtr ?>" alt="#">
            </div>
            <div class="nom-guitariste">
                <h2><?php echo $guitariste->nom ?></h2>
            </div>
            <div class="moyenne-notes">
                <p>moyenne de <?php echo number_format($guitariste->moyenne_notes, 1) ?>/10</p>
            </div>
        </div>
        <div class="contSeparation">
            <hr class="separation">
        </div>
    <?php
        $position++;
    }
    ?>

</div>