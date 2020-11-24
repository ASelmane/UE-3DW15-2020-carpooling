<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';

$controller = new AnnoncesController();
echo $controller->updateAnnonce();
?>

<p>Mise à jour d'une annonces</p>
<form method="post" action="annonces_update.php" name ="annonceUpdateForm">
    <label for="id">ID Annonce :</label>
    <input type="text" name="id">
    <br />
    <label for="user">ID Utilisateur :</label>
    <input type="text" name="user">
    <br />
    <label for="lieuDepart">Lieu de depart :</label>
    <input type="text" name="lieuDepart">
    <label for="dateDepart">Date du depart (Y-m-d H:m) :</label>
    <input type="datetime-local" name="dateDepart">
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
    <label for="car">ID Voiture :</label>
    <input type="text" name="car">
    <br />
    <input type="submit" value="Modifier l'annonce">
</form>