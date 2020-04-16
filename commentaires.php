<form method="post" action="commentaires_post.php?acteur=<?php echo $donnees['id_acteur']; ?>">
<p>Ajouter votre commentaire</p>
<label for="commentaire">Commentaire</label><textarea name="commentaire" id="commentaire"></textarea>
<input type="hidden" name="acteur" value="<?php $_GET['acteur']?>"/>
<input type="submit" value="Envoyer"/>
</form>