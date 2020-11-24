<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new CarsController();
echo $controller->createCar();
?>

<p>Création d'une voiture</p>
<form method="post" action="cars_create.php" name ="carCreateForm">
    <label for="marque">Marque :</label><br />
    <input type="text" name="marque">
    <br />
    <label for="modele">Modèle :</label><br />
    <input type="text" name="modele">
    <br />
    <label for="couleur">Couleur :</label><br />
    <input type="text" name="couleur">
    <br />
    <input type="submit" value="Créer une voiture">
</form>

<?php require 'footer.php'; ?>