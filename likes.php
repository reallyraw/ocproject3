<?php

$acteur=$_GET['acteur'];
$stmtlikes = $bdd->prepare('SELECT * FROM likes WHERE acteur_id = ?');
$stmtlikes->execute(array($acteur));
$rowlikes = $stmtlikes->fetch(PDO::FETCH_ASSOC);

$hide='style="display:none;"';
$show='';

$createlike = $bdd->prepare('SELECT * FROM likes WHERE username = ? AND acteur_id = ?');
$createlike->execute(array($_SESSION['username'], $_GET['acteur']));
$row = $createlike->fetch(PDO::FETCH_ASSOC);

$count = $createlike->rowCount();

if($count == 0) {
        $preparelikes=$bdd->prepare("INSERT INTO likes(acteur_id, username, count) VALUES(?, ?, ?)");
        $preparelikes->execute(array($_GET['acteur'], $_SESSION['username'], 0));
}

if($row['count'] == 0) {
    $like=$show;
    $like_active=$hide;
    $dislike=$show;
    $dislike_active=$hide;
}

if($row['count'] == -1) {
    $like=$show;
    $like_active=$hide;
    $dislike=$hide;
    $dislike_active=$show;
}

if($row['count'] == 1) {
    $like=$hide;
    $like_active=$show;
    $dislike=$show;
    $dislike_active=$hide;
}


try
{
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["like"])) {
        $action_like=$bdd->prepare("UPDATE likes SET count=? WHERE acteur_id=? AND username=?");
        $action_like->execute(array($row['count']+1, $_GET['acteur'], $_SESSION['username']));
        header('location: page_acteur.php?acteur='.$_GET['acteur']);
        die();
    }
    if(isset($_POST["like-active"])) {
        $action_like=$bdd->prepare("UPDATE likes SET count=? WHERE acteur_id=? AND username=?");
        $action_like->execute(array($row['count']-1, $_GET['acteur'], $_SESSION['username']));
        header('location: page_acteur.php?acteur='.$_GET['acteur']);
        die();
    }
    if(isset($_POST["dislike"])) {
        $action_like=$bdd->prepare("UPDATE likes SET count=? WHERE acteur_id=? AND username=?");
        $action_like->execute(array($row['count']-1, $_GET['acteur'], $_SESSION['username']));
        header('location: page_acteur.php?acteur='.$_GET['acteur']);
        die();
    }
    if(isset($_POST["dislike-active"])) {
        $action_like=$bdd->prepare("UPDATE likes SET count=? WHERE acteur_id=? AND username=?");
        $action_like->execute(array($row['count']+1, $_GET['acteur'], $_SESSION['username']));
        header('location: page_acteur.php?acteur='.$_GET['acteur']);
        die();
    }
}
catch(PDOException $error)
{
     $message = $error->getMessage();
};

$total_likes=$bdd->prepare('SELECT SUM(count) as liked FROM likes WHERE acteur_id = ?');
$total_likes->execute(array($acteur));
$nblikes = $total_likes->fetch(PDO::FETCH_ASSOC);?>


<div class='top-bloc container'>
<div class='bloc round'><?php echo $nblikes['liked']; ?></div>
<div class='bloc'>
<form method="post" class='top-bloc'>
<input class='bloc' <?php echo $like;?> type='submit' value='👍' border="0" alt="Submit" name='like'/>
<input class='bloc' <?php echo $like_active;?> type='submit' value="J'aime✅" border="0" alt="Submit" name='like-active'/>
<input class='bloc' <?php echo $dislike;?> type='submit' value='👎' border="0" alt="Submit" name='dislike'/>
<input class='bloc' <?php echo $dislike_active;?> type='submit' value="Je n'aime pas ✅"  border="0" name='dislike-active' alt="Submit"/>
</form>
</div>
</div>
