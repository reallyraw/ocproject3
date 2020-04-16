<header>
    <img class='resize inside-block logo' src='img/logo.png' />

    <div class='profile inside-block'>
            <p>
            <?php if(isset($_SESSION["username"]))  
                {  
                        echo '<img class="profile-img" src="img/user.png">';
                        echo $_SESSION["username"];
                        echo '<a href="action-logout.php">Se déconnecter</a>';
                }

                else{}   
                ?>
    </div>
</header>
