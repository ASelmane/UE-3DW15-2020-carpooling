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
        $dateReservation = date('H:i d-m-Y');
        // If the form have been submitted :
        if (isset($_POST['idUser']) &&
            isset($_POST['idAnnonce'])) {
            // Create the Reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                null,
                $_POST['idUser'],
                $_POST['idAnnonce'],
                $dateReservation
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
            $usersHtml = '';
            if (!empty($reservation->getUser())) {
                $usersHtml .= 'Réservé par ';
                foreach ($reservation->getUser() as $user) {
                    $usersHtml .= $user->getFirstname() . ' ' . $user->getLastname() . ' ';
                }
            }
            $annoncesHtml = '';
            if (!empty($reservation->getAnnonce())) {
                foreach ($reservation->getAnnonce() as $annonce) {
                    $annoncesHtml .= $annonce->getLieuDepart() . ' ==> ' . $annonce->getLieuArrivee() . ' '. $annonce->getDateDepart()->format('H:i d-m-Y'). ' |  ' ;
                }
            }
            $html .=
                '#' . $reservation->getId() . ' | ' .
                $annoncesHtml . ' ' .
                $usersHtml . ' ' .
                ' à '. $reservation->getDateReservation()->format('H:i d-m-Y') .'<br />';
        }

        return $html;
    }

    /**
     * Update the Reservation.
     */
    public function updateReservation(): string
    {
        $html = '';
        $dateReservation = date('H:i d-m-Y');
        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['idUser']) &&
            isset($_POST['idAnnonce'])) {
            // Update the Reservation :
            $reservationsService = new ReservationsService();
            $isOk = $reservationsService->setReservation(
                $_POST['id'],
                $_POST['idUser'],
                $_POST['idAnnonce'],
                $dateReservation
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
