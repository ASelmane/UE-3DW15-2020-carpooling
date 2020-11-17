<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new CarsController();
echo $controller->createCar();
?>

<p>Création d'une voiture</p>
<form method="post" action="cars_create.php" name ="carCreateForm">
    <label for="marque">Marque :</label>
    <input type="text" name="marque">
    <br />
    <label for="modele">Modèle :</label>
    <input type="text" name="modele">
    <br />
    <label for="couleur">Couleur :</label>
    <input type="text" name="couleur">
    <br />
    <input type="submit" value="Créer une voiture">
</form>