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
<section class="container center">
    <article class='acteurs_index'>
    <img class='img-acteur' src='<?php echo $donnees['image_acteur'] ; ?>' />
    <p class='txt_acteur'>
    <h3>
        <?php echo htmlspecialchars($donnees['nom_acteur']); ?>
    </h3>
    <?php echo nl2br(substr($donnees['text_acteur'], 0, 98)); ?>...
    </p>

    <p class='readnext'><a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite...</a></em>
    </p>
    </article>
</section>
    <?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
