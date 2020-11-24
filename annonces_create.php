<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new AnnoncesController();
echo $controller->createAnnonce();
?>

<p>Création d'une annonce</p>
<form method="post" action="annonces_create.php" name ="annonceCreateForm">
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
    <label for="place">Place disponible :</label><br />
    <input type="text" name="place">
    <br />
    <label for="prix">Prix :</label><br />
    <input type="text" name="prix">
    <br />
    <label for="car">ID Voiture :</label><br />
    <input type="text" name="car">
    <br />
    <input type="submit" value="Créer une annonce">
</form>

<?php require 'footer.php'; ?>