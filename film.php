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
        SELECT film.titre, genre.libelle, realisateur.prenom, realisateur.nom, film.date_de_sortie, film.duree , film.description
        FROM film
        INNER JOIN genre ON film.genre = genre.id
        INNER JOIN realisateur ON film.realisateur = realisateur.id
        WHERE film.id = :id
    ");
    $resultat->execute(['id' => $id]);
    $film = $resultat->fetch(PDO::FETCH_OBJ);

    if($film) {
        echo "<h1>$film->titre :</h1>";
        echo "<p>$film->date_de_sortie en salle | $film->duree min | $film->libelle</p>";
        echo "<p>De $film->prenom $film->nom</p>";
        echo "<p>Synopsis : $film->description</p>";
    } else {
        echo "<p>Film not found.</p>";
    }
} else {
    echo "<p>No film id provided.</p>";
}
?>

</body>
</html>