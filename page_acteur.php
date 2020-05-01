<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}


require 'bdd-connect.php';

// Récupération du billet
$req = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur = ?');
$req->execute(array($_GET['acteur']));
$donnees = $req->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GBAF - <?php echo $donnees['nom_acteur']; ?></title>

<link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>

        <?php require 'header.php'; ?>

        <p class='center'><a href="index.php">Retour à la page d'accueil</a></p>
<article>
<div class="center container">
<div class='acteurs_index'>
    <h3>
        <?php echo htmlspecialchars($donnees['nom_acteur']); ?>
    </h3>

    <div class='acteur-bloc'>
    <img class='img-pres' alt='<?php echo $donnees['nom_acteur'] ; ?>' src='<?php echo $donnees['image_acteur'] ; ?>' />
    <p>
    <?php echo nl2br($donnees['text_acteur']); ?>
    </p>
    </div>
</div>
</div>

<div class='center container'>

<div class='acteurs_index'>

<div class='top-bloc'>
<?php
$reqcom=$bdd->prepare('SELECT COUNT(*) FROM commentaires WHERE id_acteur=?');
$reqcom->execute(array($_GET['acteur']));
$nbcom=$reqcom->fetch();
$countcom = $nbcom[0];
?>
<h2 class='left bloc'><?php echo $countcom; ?> commentaire<?php if ($countcom != 1) {echo 's';
                      }; ?></h2>
<div class='right bloc'>
<?php require 'likes.php'; ?>
</div>
</div>
<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT username, commentaire, date_commentaire FROM commentaires WHERE id_acteur = ? ORDER BY date_commentaire');
$req->execute(array($_GET['acteur']));

while ($donnees = $req->fetch())
{
    ?>
<p class='left'><strong><?php echo htmlspecialchars($donnees['username']); ?></strong> le <?php echo $donnees['date_commentaire']; ?></p>
<p class='left'><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
    <?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>
<?php require 'commentaires.php'; ?>

</div>

</div>

</article>

<?php require 'footer.php'; ?>

</body>
</html>
