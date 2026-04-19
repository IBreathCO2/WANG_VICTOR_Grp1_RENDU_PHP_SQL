<?php

    require 'connexion.php'; /**bases de donnés a attraper une derniere fois*/

    try {
        if (isset($_GET['id'])) { //attrape l'id selectionné et la supprime
            $delete = $pdo->prepare("DELETE FROM cartes WHERE id = :id");  //si il y a pas WHERE id toute les cartes seraient supp
            $delete->execute([
                'id' => $_GET['id']
            ]);
        }  //remplace :id par le vrai et supp definitivement la carte
		
        header('Location: ../page5.php');
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression de la carte : " . $e->getMessage(); // si suppresion echoue affiche message 
    }
?>