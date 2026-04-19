<?php
    require 'crud_axe/connexion.php';  
    /**exécute le fichier connexion.php en allant le chercher dans le dossier crud_axe */

    $sql = "SELECT * FROM cartes"; /** récupère toutes les cartes de la table */
    $tri = 'nom';

    if (isset($_GET['search']) && $_GET['search'] != '') {  /**vérifie si l'utilisateur a tapé quelque chose dans le champ recherche */
        $search = $_GET['search'];
        $sql .= " WHERE (nom LIKE '%".$search."%' OR description LIKE '%".$search."%' OR rarete LIKE '%".$search."%')";
        /** cherche le mot dans le nom, la description et la rareté */
    }

    $triAutorise = ['nom', 'prix', 'rarete']; 
    if (isset($_GET['tri']) && in_array($_GET['tri'], $triAutorise)) { 
        /**verifie que ce qui est demandé est bien dans liste des tris autorisés pour eviter tout probleme */
        $tri = $_GET['tri'];
        $sql .= " ORDER BY $tri ASC"; /**trier par ordre croissant */
    } else {
		$tri = 'nom'; /**reste sur tri par nom par si aucun tri valide */
	}

    $requete = $pdo->prepare($sql);
    $requete->execute();

    $cartes = $requete->fetchAll(PDO::FETCH_ASSOC);  /**récupère tous les résultats sous forme de tableau utilisable en PHP */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/vocaloid" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Catalogue de cartes</title>

    <style>     /**css pour clean */
        .catalogue-cartes {
            padding: 40px;
            max-width: 800px;
            font-family: 'Vocaloid', sans-serif;
        }

        h1 {
            font-size: 2rem;
            color: #2a2a2a;
            border-bottom: 2px solid #2a2a2a;
            padding-bottom: 10px;
            margin-bottom: 24px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 28px;
        }

        input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        button {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            background: #2a2a2a;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        ul {    /**stylise tout ce qui contient dans <ul> */
            list-style: none;
            padding: 0;
            margin-bottom: 28px;
        }

        li {     /**stylise tout ce qui dans <li> */
            background: white;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 12px;
        }

        a {      /**stylise tout ce qui a dans <a> */
            color: #2a2a2a;
        }

        a.supprimer {    /**stylise seulement la classe supprimer */
            color: #c0392b;
        }
 
        .btn {
            padding: 8px 18px;
            border-radius: 6px;
            border: none;
            background: #2a2a2a;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

    </style>

</head>
<body class="page5">

    <div class="catalogue-cartes">

        <h1>Catalogue de cartes</h1>

        <form method="GET" action="page5.php">
            <label>Trier par : </label>

                <select name="tri" onchange="this.form.submit()"> <!--quand change la sélection le formulaire s'envoie automatiquement sans cliquer sur rechercher-->
                    <option value="nom"    <?php echo $tri === 'nom'    ? 'selected' : ''; ?>>Nom</option>
                    <!--si tri actuel est "nom" l'option reste sélectionnée après le rechargement de la page sinon rien-->
                    <option value="prix"   <?php echo $tri === 'prix'   ? 'selected' : ''; ?>>Prix</option> 
                    <option value="rarete" <?php echo $tri === 'rarete' ? 'selected' : ''; ?>>Rareté</option>
                </select>

                <input type="text" name="search" placeholder="Votre recherche"> <!--envoie le texte tapé dans l'URL-->
                <button type="submit">Rechercher</button>
        </form>

        <ul>
        <?php
            foreach ($cartes as $carte) {
                echo "<li>";
                echo $carte['nom'] . ' - ' . $carte['rarete'] . ' - ' . $carte['prix'] . ' € / Stock : ' . $carte['stock'] . "<br>";
                echo $carte['description'];
                echo "<a class='supprimer' href='crud_axe/delete.php?id=".$carte['id']."' onclick=\"return confirm('Supprimer cette carte ?')\"> Supprimer </a>";
                /** cliquer sur supprimer va vers le fichier delete.php en lui envoyant l'id de la carte */
                /**affiche "supprimer cette carte ?" avant de supprimer si on clique "annuler" rien ne se passe */
                echo "<a href='crud_axe/update.php?id=".$carte['id']."'> Modifier </a>";
                /**cliquer va vers le fichier update.php en envoyant l'id de la carte pour modifier */
                echo "</li>";
            }
        ?>
        </ul>

        <a class="btn" href="crud_axe/create.php">Ajouter une carte</a> <!--lien vers create.php pour ajouter nouvelle carte-->

    </div>

<script src="main.js"></script>
</body>
</html>



        