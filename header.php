<?php

$bdd = new PDO('mysql:host=localhost;port=3308;dbname=oc_gbaf', 'root', '');
$hide='style="display:none;"';
$show='';


if(isset($_SESSION["username"])) {
        $blocuser=$show;
        $query = "SELECT * FROM membres WHERE username = ?";
        $statement = $bdd->prepare($query);
        $statement->execute(array($_SESSION['username']));
        $row = $statement->fetch(PDO::FETCH_ASSOC);
} else {
    $blocuser=$hide;
    $row='';
}

?>


<header>
    <img class='logo' src='img/logo.png' />

    <div class='profile' <?php echo $blocuser; ?>>
            <a href='userpage.php' class='top-bloc'>
            <p class="flotte bloc">
            <img class='profile-img' src="img/user.png" />
            </p>
            <p class='username bloc'>
            <?php echo $row['prenom']; ?> <?php echo $row['nom']; ?>
            </p>
            </a>
    </div>
</header>
