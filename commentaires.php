<?php
$querycom = "SELECT * FROM commentaires WHERE username = ? AND id_acteur = ?";
$statementcom = $bdd->prepare($querycom);
$statementcom->execute(array($_SESSION["username"], $_GET['acteur']));
$countposted = $statementcom->rowCount();


if($countposted == 0) {?>
    <div class='acteurs_index'><form method="post" action="commentaires_post.php?acteur=<?php echo $_GET['acteur']; ?>">
    <p>Ajouter votre commentaire</p>
    <label for="commentaire">Commentaire</label><textarea name="commentaire" id="commentaire"></textarea>
    <input type="hidden" name="acteur" value="<?php $_GET['acteur']?>"/>
    <input type="submit" value="Envoyer"/>
    </form>
    </div>

<?php } ?>