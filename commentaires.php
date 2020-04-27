<?php
$querycom = "SELECT * FROM commentaires WHERE username = ?";
$statementcom = $bdd->prepare($querycom);
$statementcom->execute(array($_SESSION["username"]));
$countposted = $statementcom->rowCount();
if($countposted > 0) { $hide='style="display:none;"';
} else {
    $hide='';
}


?>

<div <?php echo $hide; ?>>
<form method="post" action="commentaires_post.php?acteur=<?php echo $_GET['acteur']; ?>">
<p>Ajouter votre commentaire</p>
<label for="commentaire">Commentaire</label><textarea name="commentaire" id="commentaire"></textarea>
<input type="hidden" name="acteur" value="<?php $_GET['acteur']?>"/>
<input type="submit" value="Envoyer"/>
</form>
</div>
