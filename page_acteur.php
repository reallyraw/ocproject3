<?php
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>

<link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>

        <?php include 'header.php'; ?>

        <p><a href="index.php">Retour à la page d'accueil</a></p>

<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupération du billet
$req = $bdd->prepare('SELECT * FROM acteurs WHERE id_acteur = ?');
$req->execute(array($_GET['acteur']));
$donnees = $req->fetch();
?>

<div class="acteurs_index container">
    <h3>
        <?php echo htmlspecialchars($donnees['nom_acteur']); ?>
    </h3>

    <div class='acteur-bloc'>
    <img src='<?php echo $donnees['image_acteur'] ; ?>' />
    <p>
    <?php echo nl2br(htmlspecialchars($donnees['text_acteur'])); ?>
    </p>
    </div>
</div>

<h2>Commentaires</h2>

<?php
$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT username, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
$req->execute(array($_GET['acteur']));

while ($donnees = $req->fetch())
{
?>
<p><strong><?php echo htmlspecialchars($donnees['username']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} // Fin de la boucle des commentaires
$req->closeCursor();
?>

<?php include 'commentaires.php'; ?>

<?php include 'footer.php'; ?>

</body>
</html>