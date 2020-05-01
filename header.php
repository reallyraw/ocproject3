<?php

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');


if(isset($_SESSION["username"])) {
        $query = "SELECT * FROM membres WHERE username = ?";
        $statement = $bdd->prepare($query);
        $statement->execute(array($_SESSION['username']));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
}

?>


<header>
    <img class='logo' src='img/logo.png' alt='GBAF'/>

    <?php if(isset($_SESSION["username"])){ ?>
        <div class='profile' >
            <a href='userpage.php' class='top-bloc'>
            <p class="flotte bloc">
            <img class='profile-img' src="img/user.png" alt='Utilisateur connecté' />
            </p>
            <p class='username bloc'>
            <?php echo $row['prenom']; ?> <?php echo $row['nom']; ?>
            </p>
            </a>
            <a href='action-logout.php'>Se déconnecter</a>
    </div>
<?php } ?>

</header>
