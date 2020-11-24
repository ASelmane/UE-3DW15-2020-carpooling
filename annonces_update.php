<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new AnnoncesController();
echo $controller->updateAnnonce();
?>

<p>Mise à jour d'une annonces</p>
<form method="post" action="annonces_update.php" name ="annonceUpdateForm">
    <label for="id">ID Annonce :</label><br />
    <input type="text" name="id">
    <br />
    <label for="user">ID Utilisateur :</label><br />
    <input type="text" name="user">
    <br />
    <label for="lieuDepart">Départ :</label><br />
    <input type="text" name="lieuDepart">
    <input type="datetime-local" placeholder="h:m dd-mm-yyyy" name="dateDepart">
    <br />
    <label for="lieuArrivee">Arrivée :</label><br />
    <input type="text" name="lieuArrivee">
    <br />
    <label for="place">place dispo :</label><br />
    <input type="text" name="place">
    <br />
    <label for="prix">Prix :</label><br />
    <input type="text" name="prix">
    <br />
    <label for="car">ID Voiture :</label><br />
    <input type="text" name="car">
    <br />
    <input type="submit" value="Modifier l'annonce">
</form>

<?php require 'footer.php'; ?>