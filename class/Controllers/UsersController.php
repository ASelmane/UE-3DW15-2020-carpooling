<?php

namespace App\Controllers;

use App\Services\UsersService;

class UsersController
{
    /**
     * Return the html for the create action.
     */
    public function createUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday']) &&
            isset($_POST['cars'])) {
            // Create the user :
            $usersService = new UsersService();
            $userId = $usersService->setUser(
                null,
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );

            // Create the user cars relations :
            $isOk = true;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $usersService->setUserCar($userId, $carId);
                }
            }
            if ($userId && $isOk) {
                $html = 'Utilisateur créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getUsers(): string
    {
        $html = '
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date d\'anniversaire</th>
                    <th>Voitures</th>
                    <th>Annonces</th>
                    <th>Réservations</th>
                </tr>
            </thead>
            <tbody>';

        // Get all users :
        $usersService = new UsersService();
        $users = $usersService->getUsers();

        // Get html :
        foreach ($users as $user) {
            $carsHtml = '';
            if (!empty($user->getCars())) {
                foreach ($user->getCars() as $car) {
                    $carsHtml .= $car->getMarque() . ' ' . $car->getModele() . ' ' . $car->getCouleur() . ' <br /> ';
                }
            }
            $annoncesHtml = '';
            if (!empty($user->getAnnonces())) {
                foreach ($user->getAnnonces() as $annonce) {
                    $annoncesHtml .= $annonce->getLieuDepart() . ' ==> ' . $annonce->getLieuArrivee() . ' | '. $annonce->getDateDepart()->format('H:i d-m-Y'). ' <br /> ' ;
                }
            }
            $reservationsHtml = '';
            if (!empty($user->getReservations())) {
                foreach ($user->getReservations() as $reservation) {
                    $reservationsHtml .=' #' . $reservation->getId() . ' | Annonce: ' . $reservation->getIdAnnonce() . ' | '. $reservation->getDateReservation()->format('H:i d-m-Y'). ' <br /> ' ;
                }
            }
            $html .='
                    <tr>
                        <td> #'. $user->getId() . ' </td>' .
                        '<td> '. $user->getFirstname() . ' ' . $user->getLastname() . ' </td>' .
                        '<td> '. $user->getEmail() . ' </td>' .
                        '<td> '. $user->getBirthday()->format('d-m-Y') . ' </td>' .
                        '<td> '. $carsHtml . ' </td>' .
                        '<td> '. $annoncesHtml . ' </td>' .
                        '<td> '. $reservationsHtml. ' </td>
                    </tr>';
        }
        $html .='</tbody>
        </table>';

        return $html;
    }

    /**
     * Update the user.
     */
    public function updateUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['firstname']) &&
            isset($_POST['lastname']) &&
            isset($_POST['email']) &&
            isset($_POST['birthday']) &&
            isset($_POST['cars'])) {
            // Update the user :
            $usersService = new UsersService();
            $result = $usersService->setUser(
                $_POST['id'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['birthday']
            );
            //update the user cars relations :
            $isOk = true;
            $userId = $_POST['id'] ;
            if (!empty($_POST['cars'])) {
                foreach ($_POST['cars'] as $carId) {
                    $isOk = $usersService->setUserCar($userId, $carId);
                }
            }
            if ($result || $isOk) {
                $html = 'Utilisateur mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'utilisateur.';
            }
        }

        return $html;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $usersService = new UsersService();
            $isOk = $usersService->deleteUser($_POST['id']);
            if ($isOk) {
                $html = 'Utilisateur supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'utilisateur.';
            }
        }

        return $html;
    }
}
