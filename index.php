<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<?php
require_once('pdo.php');

$resultat = $dbPDO->prepare("
    SELECT film.titre, genre.libelle, realisateur.prenom, realisateur.nom, film.`date_de_sortie` as annee
    FROM film
    INNER JOIN genre ON film.genre = genre.id
    INNER JOIN realisateur ON film.realisateur = realisateur.id
");
$resultat->execute();
$films = $resultat->fetchAll(PDO::FETCH_CLASS);

echo"<h1>Liste des meilleurs Films des années 2010 : </h1>";

foreach($films as $film) {
    echo "<li> $film->titre ( $film->libelle de $film->prenom $film->nom , $film->annee ) </li>";
}
?>

</body>
</html>
