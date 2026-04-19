<?php
    require 'connexion.php'; /**a la recherche de bases de donnés */

    try {
        if (isset($_GET['id'])) { // recupere l'id dans URL
			
            $requete = $pdo->prepare("SELECT * FROM cartes WHERE id = :id"); // cherceh la carte qui a cette id dans la base
            $requete->execute([
				'id' => $_GET['id']
			]);
			
            $carte = $requete->fetch(PDO::FETCH_ASSOC);
			//recupere la carte a midifier 

            if (!$carte) {
                header('Location: ../page5.php');
                exit;
            }
			// si on trouve pas le produit, on redirige
        }

        if (isset($_POST['nom'], $_POST['prix'], $_POST['stock'], $_GET['id'])) {
            $modification = $pdo->prepare("UPDATE cartes SET nom = :nom, description = :description, rarete = :rarete, prix = :prix, stock = :stock WHERE id = :id");
			//nouvelles lignes dont les emplacements seront remplacer ci-dessous dans table de cartes 
			// modifie uniquement carte avec cette id sinon tout les cartes seront modifier

            $modification->execute([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'rarete' => $_POST['rarete'],
                'prix' => $_POST['prix'],
                'stock' => $_POST['stock'],
                'id' => $_GET['id']
            ]);
			//remplace :valeur par celle ci-dessus
			//id => precise quelle carte a modifier

            header('Location: ../page5.php');
            exit;
        }	
		//une fois la carte modifier renvoie page5
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage(); //affiche message si une erreur
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/vocaloid" rel="stylesheet">
    <title>Modifier une carte</title>

    <style>
			/**un peu de style pour rendre joli */
        * {  /* "*" = tout les elements de la page */
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Vocaloid', sans-serif;
            background: #e8f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: white;
            border-radius: 14px;
            padding: 40px;
            width: 460px;
        }

        h1 {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            color: #555;
        }

        input, textarea, select {
            width: 100%;
            padding: 9px;
            border: 1px solid #aaa;
            border-radius: 6px;
            margin-bottom: 14px;
        }

        textarea {
            min-height: 80px;
        }

        button {
            padding: 10px 20px;
            background: #2a2a2a;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        .annuler {
            padding: 10px 20px;
            border: 1px solid #aaa;
            border-radius: 8px;
            color: #555;
            text-decoration: none;
            margin-left: 10px;
        }

        .annuler:hover {
            background: #eee;
        }

    </style>

</head>
<body>

    <div class="container"> <!--boite blance comme pour create.php-->
        <h1>Modifier la carte</h1>

        <form method="POST" action="update.php?id=<?php echo $carte['id']; ?>">
		<!--envoie id de carte a modifier-->
            <label>Nom</label>
            <input type="text" name="nom" value="<?php echo $carte['nom']; ?>" required>
			<!--affiche valeur de carte dans champ pour modifier-->

            <label>Description</label>
            <textarea name="description"><?php echo $carte['description']; ?></textarea>
			<!---attention valeur de textearea se met entre les balises et pas dans "value"-->

            <label>Rareté</label>
            <select name="rarete">
                <option <?php echo $carte['rarete'] === 'Commune'     ? 'selected' : ''; ?>>Commune</option>
				<!--compare rareté de carte avec celle actuel si correspond ajoute "selected" pour que l'option soit séléctionné par defaut-->
                <option <?php echo $carte['rarete'] === 'Peu commune' ? 'selected' : ''; ?>>Peu commune</option>
                <option <?php echo $carte['rarete'] === 'Rare'        ? 'selected' : ''; ?>>Rare</option>
                <option <?php echo $carte['rarete'] === 'Légendaire'  ? 'selected' : ''; ?>>Légendaire</option>
            </select>

            <label>Prix</label>
            <input type="number" name="prix" step="0.01" value="<?php echo $carte['prix']; ?>" required>
			<!--meme chose que pour "nom"-->

            <label>Stock</label>
            <input type="number" name="stock" value="<?php echo $carte['stock']; ?>" required>

            <button type="submit">Modifier</button>
            <a class="annuler" href="../page5.php">Annuler</a>
			<!--envoie formulaire avec nouvelles valeurs sinon retourne a la page écatalogue" sans rien modifier-->
        </form>
    </div>

</body>
</html>