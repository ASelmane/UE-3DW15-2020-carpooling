<?php

use App\Controllers\UsersController;

require __DIR__ . '/vendor/autoload.php';
require 'header.php';
?>
<p>Liste des utilisateurs</p>
<?php
$controller = new UsersController();
echo $controller->getUsers();
?>

<div class="action">
<a href="users_create"><span>Créer un Utilisateur</span></a>
<a href="users_update"><span>Mettre à jour un Utilisateur</span></a>
<a href="users_delete"><span>Supprimer un utilisateur</span></a>
</div>

<?php require 'footer.php'; ?>