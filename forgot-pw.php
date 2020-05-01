<?php
session_start();

if (isset($_SESSION['username']) AND isset($_SESSION['password'])) {
    header("Location: index.php");
    die();
}


require 'bdd-connect.php';

try
 {
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["fgt-pw"])) {
        if(empty($_POST["username"])) {
              $message = '<label>Veuillez rentrer votre nom d\'utilisateur</label>';
        }
        else
         {
               $query = "SELECT * FROM membres WHERE username = :username";
               $statement = $bdd->prepare($query);
            $statement->execute(
                array(
                         ':username'     =>     $_POST["username"]
                    )
            );
               $count = $statement->rowCount();
            if($count > 0) {
                $_SESSION['reset'] = $_POST['username'];
                header('location:reset_pw.php');
            }
            else
                {
                $message = '<label>Nom d\'utilisateur incorrect</label>';
            }
        }
    }
}
catch(PDOException $error)
{
     $message = $error->getMessage();
}
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
        <?php
        if(isset($message)) {
            echo '<font color="red">'.$message."</font>";
        }
        ?>
    <br />

    <div class="fgt-pw container login">
        <h1 class='center'>Mot de passe oublié</h1>
        <form method="post" class='center' >
                     <label><img src='img/user-small.png' alt='Utilisateur'/></label>
                     <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" />
                     <br />
                    <a href='login.php'>Retour à la page de connexion</a>
                     <input type="submit" name='fgt-pw' class="btn btn-info" value="Envoyer" />
                </form>
    </div>

    <br />

    <?php require 'footer.php'; ?>

    <br />

    </body>
</html>
