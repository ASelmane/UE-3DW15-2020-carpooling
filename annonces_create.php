<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->createAnnonce();
?>

<p>Création d'une annonce</p>
<form method="post" action="annonces_create.php" name ="annonceCreateForm">
    <label for="lieuDepart">Lieu de depart :</label>
    <input type="text" name="lieuDepart">
    <label for="dateDepart">Date du depart (Y-m-d H:m) :</label>
    <input type="text" name="dateDepart">
    <br />
    <label for="lieuArrivee">Lieu d'arrivee :</label>
    <input type="text" name="lieuArrivee">
    <br />
    <label for="place">place dispo :</label>
    <input type="text" name="place">
    <br />
    <label for="prix">Prix :</label>
    <input type="text" name="prix">
    <br />
    <input type="submit" value="Créer une annonce">
</form>