<?php
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
      if($pseudolength <= 20) {
         if($mdp == $mdp2) {
                     $pass = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
                     $reponseh = password_hash($_POST['reponse'], PASSWORD_DEFAULT);
                     $insertmbr = $bdd->prepare("INSERT INTO membres(nom, prenom, username, password, question, reponse) VALUES(?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($nom, $prenom, $username, $pass, $question, $reponseh));
                     $erreur = "Votre compte a bien été créé ! <a href=\"login.php\">Me connecter</a>";
                  } else {
            $erreur = "Vos mots de passes ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 20 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<html>
   <head>
      <title>GBAF - Inscription</title>
      <meta charset="utf-8">
   </head>
   <body>
     
      <div align="center">
         <h2>Inscription</h2>
         <br /><br />
         <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="nom">Nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre Nom" id="nom" name="nom" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="prenom">Prénom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre Prénom" id="prenom" name="prenom" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="username">Votre nom d'utilisateur :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Nom d'utilisateur" id="username" name="username" value="<?php if(isset($username)) { echo $username; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="question">Question secrète :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre question secrète" id="question" name="question" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="reponse">Réponse :</label>
                  </td>
                  <td>
                     <input type="reponse" placeholder="La réponse" id="reponse" name="reponse" />
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form> 
         <nav>
            <a href="login.php">Déjà un compte? Connectez-vous</a>
         </nav>
         <?php
    if(isset($erreur)) {
    echo '<font color="red">'.$erreur."</font>";
     }
?>  
      </div>
   </body>
</html>