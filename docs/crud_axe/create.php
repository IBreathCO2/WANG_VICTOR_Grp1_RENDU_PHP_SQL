<?php
    require 'connexion.php'; /**cherche a avoir accés a la base de donnés */

    try {
        if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['stock'])) {
            /**formulaire a bien été envoyé + champs obligatoires pas vides  + recupere donnés envoyé par formulaire*/
            $requete = $pdo->prepare("INSERT INTO cartes (nom, description, rarete, prix, stock) VALUES (:nom, :description, :rarete, :prix, :stock)");
            /**nouvelles lignes dont les emplacements seront remplacer ci-dessous dans table de cartes */

            $requete->execute([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'rarete' => $_POST['rarete'],
                'prix' => $_POST['prix'],
                'stock' => $_POST['stock']
            ]);
            /**remplace chaque :valeur par vrai valeur ci-dessus */

            header('Location: ../page5.php');
            exit;
            /**redirige vers page5 apres carte ajouté + arrete reste du code */
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout de la carte : " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.cdnfonts.com/css/vocaloid" rel="stylesheet">
    <title>Ajout d'une carte</title>

    <style>

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

    <div class="container"> <!-- grosse boite contient tout formulaire-->
        <h1>Ajouter une carte</h1>

        <form method="POST" action="create.php">  <!--envoie les données qui se fera traiter en php -->
            <div class="champ">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" required>
            </div> <!--"nom" affiché au dessus du champ lié a ce dernier, le champ est obligatoire sinon formulaire s'envoie pas-->
            <div class="champ">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
            </div> <!--meme chose ici mais pas obligatoire-->
            <div class="champ">
                <label for="rarete">Rareté</label>
                <select name="rarete" id="rarete"> <!--menu deroulé avec 4 options a selectionner-->
                    <option value="Commune">Commune</option> <!--valeur envoyé en php quand on la choisi-->
                    <option value="Peu commune">Peu commune</option>
                    <option value="Rare">Rare</option>
                    <option value="Légendaire">Légendaire</option>
                </select>
            </div>
            <div class="champ">
                <label for="prix">Prix</label>
                <input type="number" name="prix" id="prix" step="0.01" required>
            </div> <!--mepme chose qu'au début attentien a pas se perdre dans toute ces divs-->
                    <!--0.01 parce que chaque centime compte-->
            <div class="champ">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" required>
            </div>
            <div class="boutons">
                <button type="submit">Ajouter</button> <!--envoie formulaire -->
                <a href="../page5.php">Annuler</a> <!--renvoi a page5 sans rien envoyer-->
            </div>
        </form>
    </div>

</body>
</html>