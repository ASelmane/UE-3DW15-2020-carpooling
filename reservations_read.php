<?php
use App\Controllers\ReservationsController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';
?>
<p>Liste des reservations</p>
<?php
$controller = new ReservationsController();
echo $controller->getReservations();
?>

<div class="action">
<a href="reservations_create"><span>Créer une Réservation</span></a>
<a href="reservations_update"><span>Mettre à jour une Réservation</span></a>
<a href="reservations_delete"><span>Supprimer une Réservation</span></a>
</div>

<?php require 'footer.php'; ?>