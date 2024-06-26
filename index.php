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

$resultat = $dbPDO->prepare("
    SELECT film.id, film.titre, genre.libelle, realisateur.prenom, realisateur.nom, film.`date_de_sortie` as annee
    FROM film
    INNER JOIN genre ON film.genre = genre.id
    INNER JOIN realisateur ON film.realisateur = realisateur.id
");
$resultat->execute();
$films = $resultat->fetchAll(PDO::FETCH_CLASS);

echo"<h1 class='title'>Liste des meilleurs Films des années 2010 : </h1>";

foreach($films as $film) {
    echo "<li class='list-item'><a href='film.php?id=" . $film->id . "'>" . $film->titre . " </a>(" . $film->libelle . " de <a href='filmmaker.php?id=" . $film->realisateur . "'>" . $film->prenom . " " . $film->nom .  "</a> , " . $film->annee . ")</li>";
}
?>

</body>
</html>