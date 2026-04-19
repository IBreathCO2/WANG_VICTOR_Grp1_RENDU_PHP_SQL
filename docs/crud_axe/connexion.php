<?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=catalogue', 'root', '');
		/**variable qui contient la connexion + base de donnés + nom de cette base + nom d'utilisateur + mdp */
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {  /**si connection echouer on attrape l'ereur */
        echo "Erreur de connexion : " . $e->getMessage(); /**afiche message d'erreur */
    }

?>