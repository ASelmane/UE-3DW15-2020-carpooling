<?php

namespace App\Services;

use App\Entities\Car;
use App\Entities\User;
use App\Entities\Annonce;
use App\Entities\Reservation;
use DateTime;

class UsersService
{
    /**
     * Create or update an user.
     */
    public function setUser(?string $id, string $firstname, string $lastname, string $email, string $birthday): string
    {
        $userId = '';

        $dataBaseService = new DataBaseService();
        $birthdayDateTime = new DateTime($birthday);
        if (empty($id)) {
            $userId = $dataBaseService->createUser($firstname, $lastname, $email, $birthdayDateTime);
        } else {
            $dataBaseService->updateUser($id, $firstname, $lastname, $email, $birthdayDateTime);
            $userId = $id;
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $dataBaseService = new DataBaseService();
        $usersDTO = $dataBaseService->getUsers();
        if (!empty($usersDTO)) {
            foreach ($usersDTO as $userDTO) {
                // Get user :
                $user = new User();
                $user->setId($userDTO['id']);
                $user->setFirstname($userDTO['firstname']);
                $user->setLastname($userDTO['lastname']);
                $user->setEmail($userDTO['email']);
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setbirthday($date);
                }

                // Get cars of this user :
                $cars = $this->getUserCars($userDTO['id']);
                $user->setCars($cars);

                // Get annonces of this user :
                $annonces = $this->getUsersAnnonces($userDTO['id']);
                $user->setAnnonces($annonces);

                // Get reservations of this user :
                $reservations = $this->getUserReservations($userDTO['id']);
                $user->setReservations($reservations);

                $users[] = $user;
            }
        }

        return $users;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteUser($id);

        return $isOk;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->setUserCar($userId, $carId);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $dataBaseService = new DataBaseService();

        // Get relation users and cars :
        $usersCarsDTO = $dataBaseService->getUserCars($userId);
        if (!empty($usersCarsDTO)) {
            foreach ($usersCarsDTO as $userCarDTO) {
                $car = new Car();
                $car->setId($userCarDTO['id']);
                $car->setMarque($userCarDTO['marque']);
                $car->setModele($userCarDTO['modele']);
                $car->setCouleur($userCarDTO['couleur']);
                $userCars[] = $car;
            }
        }

        return $userCars;
    }

    /**
     * Get Annonces of given user id.
     */
    public function getUsersAnnonces(string $userId): array
    {
        $usersAnnonces = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $usersAnnoncesDTO = $dataBaseService->getAnnoncesUsers('', $userId);
        if (!empty($usersAnnoncesDTO)) {
            foreach ($usersAnnoncesDTO as $userAnnonceDTO) {
                $annonce = new Annonce();
                $annonce->setId($userAnnonceDTO['id']);
                $annonce->setLieuDepart($userAnnonceDTO['lieuDepart']);
                $annonce->setLieuArrivee($userAnnonceDTO['lieuArrivee']);
                $date = new DateTime($userAnnonceDTO['dateDepart']);
                if ($date !== false) {
                    $annonce->setDateDepart($date);
                }
                $usersAnnonces[] = $annonce;
            }
        }

        return $usersAnnonces;
    }

    /**
     * Get reservation of given user id.
     */
    public function getUserReservations(string $userId): array
    {
        $UserReservations = [];

        $dataBaseService = new DataBaseService();

        // Get relation Annonces and Users :
        $UserReservationsDTO = $dataBaseService->getReservationUsers('', $userId);
        if (!empty($UserReservationsDTO)) {
            foreach ($UserReservationsDTO as $UserReservationDTO) {
                $reservation = new Reservation();
                $reservation->setId($UserReservationDTO['id']);
                $reservation->setIdAnnonce($UserReservationDTO['annonce_id']);
                $date = new DateTime($UserReservationDTO['dateReservation']);
                if ($date !== false) {
                    $reservation->setDateReservation($date);
                }
                $UserReservations[] = $reservation;
            }
        }

        return $UserReservations;
    }
}
