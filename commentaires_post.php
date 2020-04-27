<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}

try{
    $bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf;charset=utf8', 'root', '');
}
catch (exception $e)
{
        die('Erreur : '. $e->getMessage());
}


$id_acteur = $_GET['acteur'];
$auteur = htmlspecialchars($_SESSION['username']);
$commentaire = htmlspecialchars($_POST['commentaire']);
$commentaires = $bdd->prepare('INSERT INTO commentaires(id_acteur, username, commentaire, date_commentaire) VALUES(:acteur, :username, :commentaire, NOW()) ');
$commentaires->execute(
    array(
    'acteur' => $id_acteur,
    'username' => $auteur,
    'commentaire' => $commentaire,
    )
);

header('location: page_acteur.php?acteur='.$_GET['acteur']);
