<?php

use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new ReservationsController();
echo $controller->deleteReservation();
?>

<p>Supression d'une reservation</p>
<form method="post" action="reservations_delete.php" name ="reservationDeleteForm">
    <label for="id">Id :</label><br />
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une reservation">
</form>

<?php require 'footer.php'; ?>