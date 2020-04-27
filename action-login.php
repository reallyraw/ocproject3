<?php

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');

if (!isset($_POST['username'], $_POST['password']) ) {
    exit('Veuillez remplir les champs utilisateur et mot de passe!');
}

try
{
     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["login"])) {
        if(empty($_POST["username"]) || empty($_POST["password"])) {
             $message = '<label>Veuillez remplir tous les champs</label>';
        }
        else
         {
             $query = "SELECT * FROM membres WHERE username = :username AND password = :password";
             $statement = $bdd->prepare($query);
            $statement->execute(
                array(
                       'username'     =>     $_POST["username"],
                       'password'     =>     $_POST["password"]
                  )
            );
             $count = $statement->rowCount();
            if($count > 0) {
                $_SESSION["username"] = $_POST["username"];
                header("location:index.php");
            }
            else
             {
                 $message = '<label>Utilisateur ou mot de passe incorrect</label>';
            }
        }
    }
}
catch(PDOException $error)
{
     $message = $error->getMessage();
}
?>
