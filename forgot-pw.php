<?php
session_start();

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');

$divStyle='style="display:none"';
$divStyle2='';

try
 {
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if(isset($_POST["fgt-pw"]))
      {
           if(empty($_POST["username"]))
           {
                $message = '<label>Veuillez rentrer votre nom d\'utilisateur</label>';
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
                if($count > 0)
                {
                    $divStyle='';
                    $divStyle2='style="display:none"';
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

        <?php include 'header.php'; ?>
        <?php
    if(isset($message)) {
    echo '<font color="red">'.$message."</font>";
     }
?>
    </br>

	<div class="fgt-pw container" <?php echo $divStyle2; ?>>
        <h1>Mot de passe oublié</h1>
        <form method="post" >
                     <label>Veuillez rentrer votre nom d'utilisateur</label>
                     <input type="text" name="username" class="form-control" />
                     <br />
                     <input type="submit" name='fgt-pw' class="btn btn-info" value="Envoyer" />
                </form>
           </div>
           </form>
    </div>

    <div <?php echo $divStyle; ?>>
    <?php include 'reset_pw.php'; ?>
    </div>

    </br>

    <?php include 'footer.php'; ?>

    </br>

	</body>
</html>