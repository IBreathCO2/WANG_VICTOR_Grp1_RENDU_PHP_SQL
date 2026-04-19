<?php

      $pdo = new PDO('mysql:host=localhost;dbname=exercice_login', 'root', '');
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //connexion a exercice_login

// vérifier que la page est appelé via POST 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // récupérer et nettoyer les données du formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //Vérifier si les champs sont remplis 
    if (!empty($email) && !empty($password)) {
        //hacher le mot de passe avant de stocker dans base
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insérer les données dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)");
        $stmt->execute([
            'email' => $email,
            'mot_de_passe' => $hashedPassword 
        ]);
        //ajoute nouvel utilisateur dans table utilisateur avec mail et mdp hashé

        echo "Enregistrement réussi !"; 
    }else{
        echo "Veuillez remplir tous les champs."; //si aucun cirtére au dessu remplis envoie ce message
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>
    <form action="register.php" method="POST">
        <!--envoie donnés vers register.php qui traitera tout ca-->
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <!--verifie que le format est un mail valide-->
        <!--id lié a for de label pour quand on clique sur le label ca selectionne le champ-->

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <!--mesque ce qui est tapé par des points-->

        <button type="submit">S'inscrire</button>
        <!--envoie le formulaure a register.php-->
    </form>
    <a href="login.php">connexion</a>
    <!--si a deja un compte redirige vers page de connexion-->
</body>
</html>