<?php

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');

$req = $bdd->prepare('SELECT * FROM membres');
$donnees = $req->fetch();


try
 {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST["reset-pw"]))
    {
    $reponse = htmlspecialchars($_POST['reponse']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp = htmlspecialchars($_POST['mdp']);
           if(empty($_POST["answer"]))
           {
                $message = '<label>Veuillez répondre à la question secrète</label>';
           }
           else
           {
                $query = "SELECT * FROM membres WHERE reponse = :reponse";
                $statement = $bdd->prepare($query);
                $statement->execute(
                     array(
                          'username'     =>     $_POST["username"]
                     )
                );
                $count = $statement->rowCount();
                if($count > 0)
                {
                     $_SESSION["username"] = $_POST["username"];
                     header("location:reset_pw.php");
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

if(isset($message)) {
    echo '<font color="red">'.$message."</font>";
     }

?>
    </br>

	<div class="reset-pw container">
        <h1>Réinitialisation du mot de passe</h1>
            <form method="post">
                    <p><?php echo htmlspecialchars($donnees['question']); ?></p>
                     <label>Réponse à la question secrète</label>
                     <input type="text" name="reponse" class="form-control" />
                     <br />
                     <label>Nouveau mot de passe</label>
                     <input type="mdp" name="mdp" class="form-control" />
                     <br />
                     <label>Confirmation du mot de passe</label>
                     <input type="mdp2" name="mdp2" class="form-control" />
                     <br />
                     <input type="submit" name="reset-pw" class="btn btn-info" value="Réinitialiser" />
                </form>
           </div>
           </form>
    </div>

    </br>