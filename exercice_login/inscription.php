<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>

<form method="POST" action="register.php">
    <!--envoie donné vers register.php-->

    <label for="email">Email</label>
    <input type="email" name="email" required>
    <!--verifie que le format est un mail valide qui sera recup en php par $_POST-->

    <label for="password">Mot de passe</label>
    <input type="password" name="password" required>
    <!--masque ce qui est tapée meme chose que pour mail sinon-->

    <button type="submit">S'inscrire</button>
    <!--envoie le formulaire vers register.php-->
</form>
    
</body>
</html>