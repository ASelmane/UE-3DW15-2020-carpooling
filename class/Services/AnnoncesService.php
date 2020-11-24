<?php

namespace App\Services;

use App\Entities\Annonce;
use App\Entities\User;
use App\Entities\Reservation;
use DateTime;

class AnnoncesService
{
    /**
     * Create or update an Annonce.
     */
    public function setAnnonce(?string $id, string $lieuDepart, string $lieuArrivee, string $dateDepart, string $place, string $prix): string
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $dateDepartDateTime = new DateTime($dateDepart);
        if (empty($id)) {
            $isOk = $dataBaseService->createAnnonce($lieuDepart, $lieuArrivee, $dateDepartDateTime, $place, $prix);
        } else {
            $isOk = $dataBaseService->updateAnnonce($id, $lieuDepart, $lieuArrivee, $dateDepartDateTime, $place, $prix);
        }

        return $isOk;
    }

    /**
     * Return all Annonces.
     */
    public function getAnnonces(): array
    {
        $annonces = [];

        $dataBaseService = new DataBaseService();
        $annoncesDTO = $dataBaseService->getAnnonces();
        if (!empty($annoncesDTO)) {
            foreach ($annoncesDTO as $annonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($annonceDTO['id']);
                $annonce->setLieuDepart($annonceDTO['lieuDepart']);
                $annonce->setLieuArrivee($annonceDTO['lieuArrivee']);
                $annonce->setPlace($annonceDTO['place']);
                $annonce->setPrix($annonceDTO['prix']);
                $date = new DateTime($annonceDTO['dateDepart']);
                if ($date !== false) {
                    $annonce->setDateDepart($date);
                }
                // Get Users of this Annonce :
                $user = $this->getAnnoncesUser($annonceDTO['id']);
                $annonce->setUser($user);

                // Get reservations of this Annonce :
                $reservation = $this->getAnnonceReservations($annonceDTO['id']);
                $annonce->setReservation($reservation);

                $annonces[] = $annonce;
            }
        }

        return $annonces;
    }

    /**
     * Delete an Annonce.
     */
    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteAnnonce($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an Annonce and his User.
     */
    public function setAnnonceUser(string $annonceId, string $userId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setAnnonceUser($annonceId, $userId);

        return $isOk;
    }

    /**
     * Get User of given Annonce id.
     */
    public function getAnnoncesUser(string $annonceId): array
    {
        $annoncesUser = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $annoncesUsersDTO = $dataBaseService->getAnnoncesUsers($annonceId, '');
        if (!empty($annoncesUsersDTO)) {
            foreach ($annoncesUsersDTO as $annonceUserDTO) {
                $user = new User();
                $user->setId($annonceUserDTO['id']);
                $user->setFirstname($annonceUserDTO['firstname']);
                $user->setLastname($annonceUserDTO['lastname']);
                $annoncesUser[] = $user;
            }
        }

        return $annoncesUser;
    }

    /**
     * Get reservation of given user id.
     */
    public function getAnnonceReservations(string $annonceId): array
    {
        $AnnonceReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $AnnonceReservationsDTO = $dataBaseService->getReservationsAnnonces('', $annonceId);
        if (!empty($AnnonceReservationsDTO)) {
            foreach ($AnnonceReservationsDTO as $AnnonceReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($AnnonceReservationDTO['id']);
                $reservation->setIdUser($AnnonceReservationDTO['user_id']);
                $date = new DateTime($AnnonceReservationDTO['dateReservation']);
                if ($date !== false) {
                    $reservation->setDateReservation($date);
                }
                $AnnonceReservations[] = $reservation;
            }
        }

        return $AnnonceReservations;
    }
}
