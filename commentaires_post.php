<?php

try{
    $bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf;charset=utf8', 'root', ''); 
}
catch (exception $e)
{
    die ('Erreur : '. $e->getMessage());
}


$req = $bdd->prepare('INSERT INTO commentaires (id_acteur, username, commentaire, DATE_FORMAT(date_commentaire, %Y-%m-%d %H:%i:%s))
VALUES (:?, ?, ?, NOW()');
$req->execute(array(
    'id_acteur'=> $_POST['acteur'],
    'username'=> $_SESSION['username'],
    'commentaire'=> $_POST['commentaire'],
));

header('Location: page_acteur.php?acteur='.$_POST['acteur']);

?>