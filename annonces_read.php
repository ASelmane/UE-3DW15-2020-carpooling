<?php

use App\Controllers\AnnoncesController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';
?>
<p>Liste des annonces</p>
<?php
$controller = new AnnoncesController();
echo $controller->getAnnonces();
?>

<div class="action">
<a href="annonces_create"><span>Créer une Annonce</span></a>
<a href="annonces_update"><span>Mettre à jour une Annonce</span></a>
<a href="annonces_delete"><span>Supprimer une Annonce</span></a>
</div>

<?php require 'footer.php'; ?>