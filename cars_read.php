
<?php

use App\Controllers\CarsController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';
?>
<p>Liste des voitures</p>
<?php
$controller = new CarsController();
echo $controller->getCars();
?>

<div class="action">
<a href="cars_create"><span>Créer une Voiture</span></a>
<a href="cars_update"><span>Mettre à jour une Voiture</span></a>
<a href="cars_delete"><span>Supprimer une Voiture</span></a>
</div>

<?php require 'footer.php'; ?>