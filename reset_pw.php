<?php

session_start();


if (isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
}


require 'bdd-connect.php';
$reqres = $bdd->prepare('SELECT * FROM membres WHERE username=?');
$reqres->execute(array($_SESSION['reset']));
$donnees = $reqres->fetch();

try
 {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["reset-pw"])) {
        $reponse = htmlspecialchars($_POST['reponse']);
        $mdp = htmlspecialchars($_POST['mdp']);
        $mdp2 = htmlspecialchars($_POST['mdp2']);
        if(empty($_POST["reponse"])) {
             $message = '<label>Veuillez répondre à la question secrète</label>';
        }
        else
           {
            if($mdp == $mdp2) {
                if (password_verify($_POST['reponse'], $donnees['reponse'])) {
                    $hashmdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                    $update = "UPDATE membres SET password=? WHERE username = ?";
                    $stmt= $bdd->prepare($update);
                    $stmt->execute([$hashmdp, $_SESSION['reset']]);
                    $message = "Mot de passe mis à jour, veuillez vous <a href='login.php'>reconnecter</a>.";
                } else {
                         $message = 'Réponse secrète incorrecte';
                }
            } else {
                 $erreur = "Vos mots de passes ne correspondent pas !";
            }
        }
    }
}
catch(PDOException $error)
{
     $message = $error->getMessage();
};
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mot de passe oublié - GBAF</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php require 'header.php'; ?>
     <h3 class='center'>
     <?php
        if(isset($message)) {
            echo $message;
        }
        ?>
     </h3>

<br />

<div class="reset-pw container login">
    <h1>Réinitialisation du mot de passe</h1>
    <h4 class='center'><?php echo $donnees['question']; ?></h4>
     <form method="post">
               <label><img src='img/answer.png' alt='Réponse' /></label>
                 <input type="text" name="reponse" placeholder="Réponse secrète" class="form-control" />
                 <br />
                 <label><img src='img/mdp.png' alt='Mot de passe'/></label>
                 <input type="password" name="mdp" placeholder="Votre nouveau mot de passe" class="form-control" />
                 <br />
                 <label><img src='img/mdp.png' alt='Confirmation'/></label>
                 <input type="password" name="mdp2" placeholder="Confirmation" class="form-control" />
                 <br />
                 <a href='login.php'>Retour à la page de connexion</a>
                 <input type="submit" name="reset-pw" class="btn btn-info" value="Réinitialiser" />
            </form>
 </div>

<br />
    <?php require 'footer.php'; ?>

    <br />

    </body>
</html>
