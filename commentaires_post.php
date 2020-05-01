<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}


require 'bdd-connect.php';


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
