<?php
session_start();

if (isset($_SESSION['username']) AND isset($_SESSION['password'])) {
    header("Location: index.php");
    die();
}


$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');
$req = $bdd->query('SELECT * FROM membres');
$donnees = $req->fetch();


try
{
     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["login"])) {
        if(empty($_POST["username"]) || empty($_POST["password"])) {
             $message = 'Veuillez remplir tous les champs';
        }
        else
         {
             $query = "SELECT * FROM membres WHERE username = :username";
             $statement = $bdd->prepare($query);
            $statement->execute(
                array(
                       'username'     =>     $_POST["username"]
                  )
            );
             $count = $statement->rowCount();
            if($count > 0) {
                $checkmbr=$statement->fetch();
                if (password_verify($_POST['password'], $checkmbr['password'])) {
                    $_SESSION["username"] = $_POST["username"];
                    header("location:login_success.php");
                } else {
                     $message = 'Mot de passe incorrect';
                }
            }
            else
             {
                 $message = 'Utilisateur incorrect';
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
        <title>Login - GBAF</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <?php require 'header.php'; ?>

     </br>

     <?php
        if(isset($message)) {
            echo '<font color="red">'.$message."</font>";
        }
        ?>

     </br>

    <div class="login container">
        <h1>Login</h1>
        <form method="post">
                     <label><img src='img/user-small.png' /></label>
                     <input type="text" name="username" placeholder="Nom d'utilisateur" class="form-control" />
                     <br />
                     <label><img src='img/mdp.png' /></label>
                     <input type="password" name="password" placeholder="Mot de passe" class="form-control" />
                     <br /><p>
                     <a href='forgot-pw.php'>Mot de passe oublié ?</a></p>
                     <br /><p>&emsp;|&emsp;</p><br /><p>
                     <a href='register.php'>Inscription</a></p>
                     <input type="submit" name="login" class="btn btn-info" value="Login" />
                </form>
           </div>
           </form>
    </div>



    </br>

    <?php require 'footer.php'; ?>

    </br>

    </body>
</html>
