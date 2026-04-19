<?php
session_start();
//demarre la session OBLIGATOIRE pour chaque page a session

if (!isset($_SESSION['user'])) { //verifie si l'utilisateur est connecté/ $_SESSION contient infos de user connecté
    header("Location: login.php");
    exit;
}
//si session existe pas redirige vers login.pgp

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue, <?php echo $_SESSION['user'] ?> !</h1>
    <!--affiche nom de user connecté stocké dans session-->
    <p>Tu es connecté.</p>
    
    <form action="logout.php" method="POST">
        <button type="submit">Se déconnecter</button>
    </form>
    <!--redirige vers logout.php qui detruirea session et deconnectera l'user-->
</body>
</html>
