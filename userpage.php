<?php
session_start();


if (!isset($_SESSION['username']) AND !isset($_SESSION['password'])) {
    header("Location: login.php");
    die();
}

$erreur='';


require 'bdd-connect.php';
if(isset($_POST['formupdate'])) {
    $username = htmlspecialchars($_POST['username']);
    $username2 = htmlspecialchars($_POST['username2']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp2 = htmlspecialchars($_POST['mdp2']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);
    if(isset($_POST['username'])) {
        if($username == $username2) {
            $pseudolength = strlen($username);
            $stmt = $bdd->prepare('SELECT username FROM membres WHERE username = ?');
            $stmt->execute(array($username));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
            if($count == 0) {
                if($pseudolength <= 20) {
                     $updatembr = $bdd->prepare("UPDATE membres SET username=? WHERE username=?");
                     $updatembr->execute(array($username, $_SESSION['username']));
                     $erreur = "Votre nom d'utilisateur a bien été mis à jour.";
                     $_SESSION['username'] = $username;
                } else {
                    $erreur = "Votre pseudo ne doit pas dépasser 20 caractères !";
                }
            } else {
                $erreur = 'Nom d\'utilisateur déjà pris.';
            }
        } else {
            $erreur = 'Les pseudos ne correspondent pas.';
        }
    }
    if(isset($_POST['mdp'])) {
        if($mdp == $mdp2) {
            $mdplength = strlen($mdp);
            if($mdplength <= 20 AND $mdplength > 5) {
                    $hashmdp=password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                     $updatembr = $bdd->prepare("UPDATE membres SET password=? WHERE username=?");
                     $updatembr->execute(array($hashmdp, $_SESSION['username']));
                     $erreur = "Votre mot de passe a bien été mis à jour.";
            } else {
                $erreur = "Votre mot de passe doit être compris entre 6 et 20 caractères !";
            }
        } else {
            $erreur = 'Les mots de passe ne correspondent pas.';
        }
    }
    if(isset($_POST['question'])) {
        if(isset($_POST['reponse'])) {
            $hashrep=password_hash($_POST['reponse'], PASSWORD_DEFAULT);
            $updatembr = $bdd->prepare("UPDATE membres SET question=?, reponse=? WHERE username=?");
            $updatembr->execute(array($question, $hashrep, $_SESSION['username']));
            $erreur = "Votre question et réponse secrète ont bien été mises à jour.";
        } else {
            $erreur = 'Veuillez indiquer une réponse secrète.';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>GBAF - Utilisateur</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <?php require 'header.php'; ?>

    <br />

    <h5 class='center'><a href='index.php'>Retour à la page d'accueil</a></h5>

    <h3 class='center'>Bienvenue sur votre page utilisateur. Ici vous pouvez modifier vos informations de compte.
    Si vous ne souhaitez pas modifier telle information, veuillez laisser la case vide.
    </h3>

    <h4 class='center'><?php echo $erreur; ?></h4>

    <div class='login container'>
      <h1>Modifier les infos de votre compte</h1>
      <form method="POST">
         <label for="username"><img src='img/user-small.png' alt='Utilisateur'/></label>
         <input type="text" placeholder="Nouveau nom d'utilisateur" id="username" name="username" />
         <br />
         <label for="username2"><img src='img/user-small.png' alt='Utilisateur'/></label>
         <input type="text" placeholder="Confirmation" id="username2" name="username2" />
         <br />
         <label for="mdp"><img src='img/mdp.png' alt='Mot de passe'/></label>
         <input type="password" placeholder="Votre nouveau mot de passe" id="mdp" name="mdp" />
         <br />
         <label for="mdp2"><img src='img/mdp.png' alt='Mot de passe'/></label>
         <input type="password" placeholder="Confirmez le nouveau mot de passe" id="mdp2" name="mdp2" />
         <br />
         <label for="question"><img src='img/answer.png' alt='Question'/></label>
         <input type="text" placeholder="Votre nouvelle question secrète" id="question" name="question" />
         <br />
         <label for="reponse"><img src='img/answer.png' alt='Reponse'/></label>
         <input type="text" placeholder="La nouvelle réponse" id="reponse" name="reponse" />
         <br />
         <a href="action-logout.php">Se déconnecter</a>
         <br />
         <input type="submit" name="formupdate" value="Mettre à jour" />
         </form>
         </div>

    <br />

    <?php require 'footer.php'; ?>

</body>

</html>
