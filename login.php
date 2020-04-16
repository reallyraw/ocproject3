<?php
session_start();

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');

try
 {
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["login"]))
      {
           if(empty($_POST["username"]) || empty($_POST["password"]))
           {
                $message = 'Veuillez remplir tous les champs';
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
                if($count > 0)
                {
                     $_SESSION["username"] = $_POST["username"];
                     header("location:login_success.php");
                }
                else
                {
                     $message = 'Utilisateur ou mot de passe incorrect';
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

        <?php include 'header.php'; ?>

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
                     <label>Nom d'utilisateur</label>
                     <input type="text" name="username" class="form-control" />
                     <br />
                     <label>Mot de passe</label>
                     <input type="password" name="password" class="form-control" />
                     <br />
                     <a href='forgot-pw.php'>Mot de passe oublié ?</a>
                     <input type="submit" name="login" class="btn btn-info" value="Login" />
                </form>
           </div>
           </form>
    </div>



    </br>

    <?php include 'footer.php'; ?>

    </br>

	</body>
</html>