<?php
session_start();


if (!isset($_SESSION['username']))
{
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

    <?php include 'header.php'; ?>

    </br>

    <?php include 'presentation.php'; ?>

    </br>

    <?php include 'acteurs.php'?>

    </br>

    <?php include 'footer.php'; ?>  

</body>

</html>