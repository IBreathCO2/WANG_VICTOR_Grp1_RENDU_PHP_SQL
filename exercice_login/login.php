<?php

session_start();
//demarre la session

if (isset($_SESSION['user'])) {
    header("Location: acceuil.php");
    exit;
}
//si deja connecté redirige vers acceuil.php sans afficher de formulaire

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = trim($_POST['mot_de_passe']);
    //supprimme espace inutile

    //valider le mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Email invalide.";

    } else if (empty($email) || empty($password)) {
        $erreur = "Tous les champs sont obligatoires.";
        //si champ vide affiche erreur aussi

    } else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=exercice_login', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //se connecte a base de donnés

            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
            //cherche utilisateur avec ce mail et recupere le resultat

            if ($utilisateur && password_verify($password, $utilisateur['mot_de_passe'])) {
                //verifie qu'on a trouve user avec ce mail et compare mdp 
                //enregistrer les informations dans la session

                $_SESSION['user'] = $utilisateur['email'];
                header("Location: acceuil.php");
                exit;
                //si tout est bon stock email et redirige 

            } else {
                $erreur = "Email ou mot de passe incorrect.";
            }

        } catch (PDOException $e) {
            $erreur = "Erreur : " . $e->getMessage();
            //si trouve quelconque erreur affiche message d'erreur
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>

    <style> /**un peu de style pour faire un "acceuil" plus chaleureux */
    
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 80px;
            background: #f0f0f0;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            width: 320px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 6px 0 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .inscrire {
            display: block;
            padding: 10px;
            margin-top: 10px;
            background: #c0392b;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
        }

        .inscrire:hover {
            background: #e74c3c;
        }

        .erreur {
            color: red;
        }

    </style>

</head>
<body>

<div class="box">
    <h2>Se connecter</h2>

    <?php if ($erreur): ?>
        <p class="erreur"><?php echo $erreur ?></p>
    <?php endif; ?>
    <!-- si $erreur pas vide affiche message-->

    <form method="POST">
        <!--envoie vers le meme fichier login.php car pas d'action-->
        <label>Email :</label>
        <input type="email" name="email" required>
        <!--verifie format de mail et recuperer valeur avec $_POST grace au nom en php-->

        <label>Mot de passe :</label>
        <input type="password" name="mot_de_passe" required>
        <!--meme chose mais masque le mdp en plus-->

        <button type="submit">Se connecter</button>
        <!--envoie formulaire vers login.php-->
    </form>

    <a class="inscrire" href="register.php">S'inscrire</a>
    <!--redirige vers register.php-->
</div>

</body>
</html>