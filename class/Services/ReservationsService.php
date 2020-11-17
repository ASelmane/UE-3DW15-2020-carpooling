<?php

namespace App\Services;

use App\Entities\Reservation;
use DateTime;

class ReservationsService
{
    /**
     * Create or update an Reservation.
     */
    public function setReservation(?string $id, string $idUser, string $idAnnonce): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($idUser, $idAnnonce);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $idUser, $idAnnonce);
        }

        return $isOk;
    }

    /**
     * Return all Reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $dataBaseService = new DataBaseService();
        $reservationsDTO = $dataBaseService->getReservations();
        if (!empty($reservationsDTO)) {
            foreach ($reservationsDTO as $reservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($reservationDTO['id']);
                $reservation->setIdUser($reservationDTO['idUser']);
                $reservation->setIdAnnonce($reservationDTO['idAnnonce']);
                $reservations[] = $reservation;
            }
        }

        return $reservations;
    }

    
    /**
     * Delete an Reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteReservation($id);

        return $isOk;
    }
}
