<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->query('SELECT * FROM acteurs');

while ($donnees = $req->fetch())
{
?>
<div class="acteurs_index container">
    <h3>
        <?php echo htmlspecialchars($donnees['nom_acteur']); ?>
    </h3>

    <div class='acteur-bloc'>
    <img src='<?php echo $donnees['image_acteur'] ; ?>' />
    <p>
    <?php echo nl2br(htmlspecialchars(substr($donnees['text_acteur'], 0, 100))); ?>...
    <em><a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite...</a></em>
    </p>
    </div>
</div>
<?php
} // Fin de la boucle des billets
$req->closeCursor();
?>