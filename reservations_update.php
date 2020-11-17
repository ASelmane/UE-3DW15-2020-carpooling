<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';

$controller = new ReservationsController();
echo $controller->updateReservation();
?>

<p>Mise à jour d'une reservation</p>
<form method="post" action="reservations_update.php" name ="reservationUpdateForm">
    <label for="id">Id :</label>
    <input type="text" name="id">
    <br />
    <label for="idUser">Votre ID utilisateur :</label>
    <input type="text" name="idUser">
    <br />
    <label for="idAnnonce">ID de l'annonce :</label>
    <input type="text" name="idAnnonce">
    <br />
    <input type="submit" value="Modifier la reservation">
</form>