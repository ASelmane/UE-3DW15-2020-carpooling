<?php

namespace App\Services;

use App\Entities\Reservation;
use App\Entities\Annonce;
use App\Entities\User;

use DateTime;

class ReservationsService
{
    /**
     * Create or update an Reservation.
     */
    public function setReservation(?string $id, string $idUser, string $idAnnonce, string $dateReservation): string
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateReservationDateTime = new DateTime($dateReservation);

        if (empty($id)) {
            $isOk = $dataBaseService->createReservation($idUser, $idAnnonce, $dateReservationDateTime);
        } else {
            $isOk = $dataBaseService->updateReservation($id, $idUser, $idAnnonce, $dateReservationDateTime);
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
                $date = new DateTime($reservationDTO['dateReservation']);
                if ($date !== false) {
                    $reservation->setDateReservation($date);
                }
                // Get Users of this Annonce :
                $user = $this->getReservationUser($reservationDTO['id']);
                $reservation->setUser($user);

                // Get annonce of this reservation :
                $annonce = $this->getReservationsAnnonce($reservationDTO['id']);
                $reservation->setAnnonce($annonce);

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

    /**
     * Get User of given reservation id.
     */
    public function getReservationUser(string $reservationId): array
    {
        $ReservationUser = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $ReservationUsersDTO = $dataBaseService->getReservationUsers($reservationId,'');
        if (!empty($ReservationUsersDTO)) {
            foreach ($ReservationUsersDTO as $annonceUserDTO) {
                $user = new User();
                $user->setId($annonceUserDTO['id']);
                $user->setFirstname($annonceUserDTO['firstname']);
                $user->setLastname($annonceUserDTO['lastname']);
                $ReservationUser[] = $user;
            }
        }

        return $ReservationUser;
    }

    /**
     * Get Annonces of given reservation id.
     */
    public function getReservationsAnnonce(string $reservationId): array
    {
        $ReservationsAnnonce = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $ReservationsAnnonceDTO = $dataBaseService->getReservationsAnnonces($reservationId,'');
        if (!empty($ReservationsAnnonceDTO)) {
            foreach ($ReservationsAnnonceDTO as $userAnnonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($userAnnonceDTO['id']);
                $annonce->setLieuDepart($userAnnonceDTO['lieuDepart']);
                $annonce->setLieuArrivee($userAnnonceDTO['lieuArrivee']);
                $date = new DateTime($userAnnonceDTO['dateDepart']);
                if ($date !== false) {
                    $annonce->setDateDepart($date);
                }
                $ReservationsAnnonce[] = $annonce;
            }
        }

        return $ReservationsAnnonce;
    }
}
