<?php

use App\Controllers\UsersController;
use App\Services\CarsService;

require __DIR__ . '/vendor/autoload.php';

$controller = new UsersController();
echo $controller->updateUser();

$carsService = new CarsService();
$cars = $carsService->getCars();
?>

<p>Mise à jour d'un utilisateur</p>
<form method="post" action="users_update.php" name ="userUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname">
    <br />
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname">
    <br />
    <label for="email">Email :</label>
    <input type="text" name="email">
    <br />
    <label for="birthday">Date d'anniversaire au format dd-mm-yyyy :</label>
    <input type="date" name="birthday">
    <br />
    <label for="cars">Voiture(s) :</label>
    <?php foreach ($cars as $car): ?>
        <?php $carName = $car->getMarque() . ' ' . $car->getModele() . ' ' . $car->getCouleur(); ?>
        <input type="checkbox" name="cars[]" value="<?php echo $car->getId(); ?>"><?php echo $carName; ?>
        <br />
    <?php endforeach; ?>
    <br />
    <input type="submit" value="Modifier l'utilisateur">
</form>