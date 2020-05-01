<?php
// Connexion à la base de données
require 'bdd-connect.php';
$req = $bdd->query('SELECT * FROM acteurs');

while ($donnees = $req->fetch())
{
    ?>
<section class="container center">
    <article class='acteurs_index'>
    <img class='img-acteur' alt='<?php echo $donnees['nom_acteur']; ?>' src='<?php echo $donnees['image_acteur'] ; ?>' />
    <div class='txt_acteur'>
    <h3>
        <?php echo htmlspecialchars($donnees['nom_acteur']); ?>
    </h3>
    <?php echo nl2br(substr($donnees['text_acteur'], 0, 98)); ?>...
    </div>

    <p class='readnext'><a href="page_acteur.php?acteur=<?php echo $donnees['id_acteur']; ?>">Lire la suite...</a>
    </p>
    </article>
</section>
    <?php
} // Fin de la boucle des billets
$req->closeCursor();
?>
