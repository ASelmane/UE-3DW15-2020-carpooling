<?php

use App\Controllers\UsersController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new UsersController();
echo $controller->createUser();

$carsService = new CarsService();
$cars = $carsService->getCars();

?>

<p>Création d'un utilisateur</p>
<form method="post" action="users_create.php" name ="userCreateForm">
    <label for="firstname">Prénom :</label><br />
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label><br />
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label><br />
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire :</label><br />
    <input type="date" name="birthday">
    <br />
    <label for="cars">Voiture(s) :</label><br />
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getMarque() . ' ' . $car->getModele() . ' ' . $car->getCouleur(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Créer un utilisateur">
</form>

<?php require 'footer.php'; ?>