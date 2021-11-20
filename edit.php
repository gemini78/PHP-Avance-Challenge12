<?php
$content = "";
$is_img = false;
if (!empty($_GET['action']) && !empty($_GET['path'])) {
    $extension = pathinfo($_GET['path'], PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $allow_extensions = ['jpg','png','jpeg'];
    if (in_array($extension, $allow_extensions)) {
        $is_img = true;
    } else {
        $content =htmlspecialchars(trim(file_get_contents($_GET['path'])));
    }
}
include('inc/head.php')
?>

<a class="button" href="/index.php">Retour à l'accueil</a>
<div class="content panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title text-uppercase">UFO's Activities report</h3>
    </div>
    <div class="panel-body">
        <h2>Contenu du fichier</h2>
       <?php 
        if ($is_img) { ?>
            <img class="img" width="200px" height="250px" src="<?= $_GET['path']; ?>" alt="">
        <?php } else { ?>
             <textarea class="contentFile" rows="15"><?= $content; ?> 
        </textarea>
        <?php }
       ?>
    </div>
    <div class="panel-footer text-right">
        <em>Classified documents</em>
    </div>
</div>
<?php include('inc/foot.php') ?>