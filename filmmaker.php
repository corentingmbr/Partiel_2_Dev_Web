<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        h1 {
            font-family: 'Jersey 15', sans-serif;
        }
        li {
            font-family: 'Raleway', sans-serif;
        }
    </style>
</head>

<body>

<?php
require_once('pdo.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $resultat = $dbPDO->prepare("
        SELECT realisateur.nationnalite, genre.libelle, realisateur.prenom, realisateur.nom, film.date_de_sortie, film.titre
        FROM realisateur
        WHERE realisateur.id = :id
    ");
    $resultat->execute(['id' => $id]);
    $realisateur = $resultat->fetch(PDO::FETCH_OBJ);

    if($realisateur) {
        echo "<h1> $realisateur->prenom $realisateur->nom :</h1>";
        echo "<p>Nationnalité : $realisateur->nationnalite</p>";
        echo "<p>Filmographie : </p>";
        echo "<ul> $realisateur->titre , $realisateur->date_de_sortie</ul>";

    } else {
        echo "<p>Filmmaker not found.</p>";
    }
} else {
    echo "<p>No Filmmaker id provided.</p>";
}
?>




</body>
</html>