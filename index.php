<?php
session_start();


if (!isset($_SESSION['username'])  AND !isset($_SESSION['password'])) {
    header("Location: login.php");
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>GBAF - Accueil</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <?php require 'header.php'; ?>

    <br />

    <?php require 'presentation.php'; ?>

    <br />

    <?php require 'acteurs.php'?>

    <br />

    <?php require 'footer.php'; ?>

</body>

</html>
