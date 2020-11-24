<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';

$controller = new AnnoncesController();
echo $controller->deleteAnnonce();
?>

<p>Supression d'une annonce</p>
<form method="post" action="annonces_delete.php" name ="annonceDeleteForm">
    <label for="id">Id :</label><br />
    <input type="text" name="id">
    <br />
    <input type="submit" value="Supprimer une annonce">
</form>

<?php require 'footer.php'; ?>