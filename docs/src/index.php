<?php
require '../vendor/autoload.php';

use GuzzleHttp\Client;

//récupère le nom envoyé en paramètre via GET
$name = $_GET['name'] ?? 'Miku';

//création du client Guzzle
$client = new Client();

//envoi de la requête vers l'API VocaDB
$response = $client->get('https://vocadb.net/api/artists', [
    'query' => [
        'query'         => $name,
        'artistTypes'   => 'Vocaloid',          //uniquement vocaloids
        'fields'        => 'Description,MainPicture',       //description + photo
        'lang'          => 'English',       //Anglais car le site est en anlais
        'nameMatchMode' => 'Partial',       //si le mot est contenu dans le nom
    ],
]);

//retourne les données au format JSON
header('Content-Type: application/json');
echo $response->getBody();