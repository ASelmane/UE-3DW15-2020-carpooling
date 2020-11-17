<?php

namespace App\Controllers;

use App\Services\ReservationsService;

class ReservationsController
{
    /**
     * Return the html for the create action.
     */
    public function createReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['idUser']) &&
            isset($_POST['idAnnonce'])) {
            // Create the Reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                null,
                $_POST['idUser'],
                $_POST['idAnnonce']
            );
            if ($isOk) {
                $html = 'Reservation créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la rerservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getReservations(): string
    {
        $html = '';

        // Get all Reservations :
        $reservationsService = new ReservationsService();
        $reservations = $reservationsService->getReservations();

        // Get html :
        foreach ($reservations as $reservation) {
            $html .=
                '#' . $reservation->getId() . ' | ' .
                'Utilisateur n°' . $reservation->getIdUser() . ' | ' .
                'Annonce n°' . $reservation->getIdAnnonce() . '<br />';
        }

        return $html;
    }

    /**
     * Update the Reservation.
     */
    public function updateReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['idUser']) &&
            isset($_POST['idAnnonce'])) {
            // Update the Reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['idUser'],
                $_POST['idAnnonce']
            );
            if ($isOk) {
                $html = 'Reservation mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la reservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a Reservation.
     */
    public function deleteReservation(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the Reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->deleteReservation($_POST['id']);
            if ($isOk) {
                $html = 'Reservation supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la reservation.';
            }
        }

        return $html;
    }
}
