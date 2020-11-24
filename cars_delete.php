<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new CarsController();
echo $controller->deleteCar();
?>

<p>Supression d'une voiture</p>
<form method="post" action="cars_delete.php" name ="carDeleteForm">
    <label for="id">Id :</label><br />
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une voiture">
</form>

<?php require 'footer.php'; ?>