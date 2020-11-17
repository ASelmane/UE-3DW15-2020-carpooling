<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->createReservation();
?>

<p>Création d'une reservation</p>
<form method="post" action="reservations_create.php" name ="reservationCreateForm">
    <label for="idUser">Votre ID utilisateur :</label>
    <input type="text" name="idUser">
    <br />
    <label for="idAnnonce">ID de l'annonce :</label>
    <input type="text" name="idAnnonce">
    <br />
    <input type="submit" value="Créer une reservation">
</form>