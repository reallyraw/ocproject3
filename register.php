<?php

session_start();


if (isset($_SESSION['username']) AND isset($_SESSION['password'])) {
    header("Location: index.php");
    die();
}


$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');

if(isset($_POST['forminscription'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $username = htmlspecialchars($_POST['username']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp2 = htmlspecialchars($_POST['mdp2']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['username']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['question']) AND !empty($_POST['reponse'])  ) {
        $pseudolength = strlen($username);
        $stmt = $bdd->prepare('SELECT username FROM membres WHERE username = :username');
        $stmt->execute(array( ':username' => $_POST['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if($count == 0) {
            if($pseudolength <= 20 AND $pseudolength > 5) {
                if (ctype_alnum($username)) {
                    if($mdp == $mdp2) {
                              $mdplength = strlen($mdp);
                        if($mdplength <= 20 AND $mdplength > 5) {
                            $pass = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                            $reponseh = password_hash($_POST['reponse'], PASSWORD_DEFAULT);
                            $insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, username, password, question, reponse) VALUES(?, ?, ?, ?, ?, ?)");
                            $insertmbr->execute(array($nom, $prenom, $username, $pass, $question, $reponseh));
                            $erreur = "Votre compte a bien été créé ! <a href=\"login.php\">Me connecter</a>";
                        } else {
                            $erreur = "Votre mot de passe doit être compris entre 6 et 20 caractères !";
                        }
                    } else {
                        $erreur = "Vos mots de passes ne correspondent pas !";
                    }
                } else {
                    $erreur= 'Veuillez n\'utiliser que des caractères alphanumériques.';
                }
            } else {
                $erreur = "Votre pseudo doit être compris entre 6 et 20 caractères !";
            }
        } else {
            $erreur = 'Nom d\'utilisateur déjà pris.';
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<!DOCTYPE html>
<html>
   <head>
      <title>GBAF - Inscription</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <meta charset="utf-8">
   </head>
   <body>

   <?php require 'header.php'; ?>

   <h3 class='center'><?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?></h3>

   <div class='login container'>
      <h1>Inscription</h1>
      <form method="POST" action="">
         <label for="nom"><img src='img/name.png' /></label>
         <input type="text" placeholder="Votre Nom" id="nom" name="nom" />
         </br>
         <label for="prenom"><img src='img/name.png' /></label>
         <input type="text" placeholder="Votre Prénom" id="prenom" name="prenom" />
         </br>
         <label for="username"><img src='img/user-small.png' /></label>
         <input type="text" placeholder="Nom d'utilisateur" id="username" name="username" />
         </br>
         <label for="mdp"><img src='img/mdp.png' /></label>
         <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
         </br>
         <label for="mdp2"><img src='img/mdp.png' /></label>
         <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
         </br>
         <label for="question"><img src='img/answer.png' /></label>
         <input type="text" placeholder="Votre question secrète" id="question" name="question" />
         </br>
         <label for="reponse"><img src='img/answer.png' /></label>
         <input type="text" placeholder="La réponse" id="reponse" name="reponse" />
         </br>
         <a href="login.php">Déjà un compte? Connectez-vous</a>
         </br>
         <input type="submit" name="forminscription" value="Je m'inscris" />
         </form>
         </div>

<?php require 'footer.php'; ?>

   </body>
</html>
