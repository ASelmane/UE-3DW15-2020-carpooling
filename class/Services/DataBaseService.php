<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format('Y-m-d'),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format('Y-m-d'),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        
        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE users, users_cars, users_annonces, reservations
                FROM users
                LEFT JOIN users_cars ON users_cars.user_id = users.id
                LEFT JOIN users_annonces ON users_annonces.user_id = users.id
                LEFT JOIN reservations ON reservations.user_id = users.id
                WHERE users.id = :id ';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    /**
     * Create a Car.
     */
    public function createCar(string $marque, string $modele, string $couleur): bool
    {
        $isOk = false;

        $data = [
            'marque' => $marque,
            'modele' => $modele,
            'couleur' => $couleur,
        ];
        $sql = 'INSERT INTO cars (marque, modele, couleur) VALUES (:marque, :modele, :couleur)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Update a car.
     */
    public function updateCar(string $id, string $marque, string $modele, string $couleur): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'marque' => $marque,
            'modele' => $modele,
            'couleur' => $couleur,
        ];
        $sql = 'UPDATE cars SET marque = :marque, modele = :modele, couleur = :couleur WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE cars, users_cars,annonces_cars
        FROM cars
        LEFT JOIN users_cars ON users_cars.car_id = cars.id
        LEFT JOIN annonces_cars ON annonces_cars.car_id = cars.id
        WHERE cars.id = :id ';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
    * Create relation bewteen an user and his car.
    */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }

    /**
     * Create an ad.
     */
    public function createAnnonce(string $lieuDepart, string $lieuArrivee, DateTime $dateDepart, string $place, string $prix): string
    {
        $annonceId = false;

        $data = [
            'lieuDepart' => $lieuDepart,
            'lieuArrivee' => $lieuArrivee,
            'dateDepart' => $dateDepart->format('Y-m-d H:i'),
            'place' => $place,
            'prix' => $prix,
        ];
        $sql = 'INSERT INTO annonces (lieuDepart, lieuArrivee, dateDepart, place, prix) VALUES (:lieuDepart, :lieuArrivee, :dateDepart, :place, :prix)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $annonceId = $this->connection->lastInsertId();
        }

        return $annonceId;
    }

    /**
     * Return all ads.
     */
    public function getAnnonces(): array
    {
        $annonces = [];

        $sql = 'SELECT * FROM annonces';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonces = $results;
        }

        return $annonces;
    }

    /**
     * Update an ad.
     */
    public function updateAnnonce(string $id, string $lieuDepart, string $lieuArrivee, DateTime $dateDepart, string $place, string $prix): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'lieuDepart' => $lieuDepart,
            'lieuArrivee' => $lieuArrivee,
            'dateDepart' => $dateDepart->format('Y-m-d H:i'),
            'place' => $place,
            'prix' => $prix,
        ];
        $sql = 'UPDATE annonces SET lieuDepart = :lieuDepart, lieuArrivee = :lieuArrivee, dateDepart = :dateDepart, place = :place, prix = :prix WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        return $isOk;
    }

    /**
     * Delete an ad.
     */
    public function deleteAnnonce(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE annonces, users_annonces, reservations, annonces_cars
                FROM annonces
                LEFT JOIN users_annonces ON users_annonces.annonce_id = annonces.id
                LEFT JOIN reservations ON reservations.annonce_id = annonces.id
                LEFT JOIN annonces_cars ON annonces_cars.annonce_id = annonces.id
                WHERE annonces.id = :id ';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
    * Create relation bewteen an user and his annonces.
    */
    public function setAnnonceUser(string $annonceId, string $userId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'annonceId' => $annonceId,
        ];
        $sql = 'INSERT INTO users_annonces (user_id, annonce_id) VALUES (:userId, :annonceId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get annonces of given user id.
     */
    public function getAnnoncesUsers(?string $annonceId, ?string $userId): array
    {
        $userAnnonces = [];
        if (!empty($userId)) {
            $data = [
                'userId' => $userId,
            ];
            $sql = '
                SELECT a.*
                FROM annonces as a
                LEFT JOIN users_annonces as ua ON ua.annonce_id = a.id
                WHERE ua.user_id = :userId';
        } else {
            $data = [
                'annonceId' => $annonceId,
            ];
            $sql = '
                SELECT u.*
                FROM users as u
                LEFT JOIN users_annonces as ua ON ua.user_id = u.id
                WHERE ua.annonce_id = :annonceId';
        }
        
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userAnnonces = $results;
        }

        return $userAnnonces;
    }

    /**
    * Create relation bewteen an annonce and his car.
    */
    public function setAnnonceCar(string $annonceId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'annonceId' => $annonceId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO annonces_cars (annonce_id, car_id) VALUES (:annonceId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given annonce id.
     */
    public function getAnnonceCars(string $annonceId): array
    {
        $annonceCars = [];

        $data = [
            'annonceId' => $annonceId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN annonces_cars as ac ON ac.car_id = c.id
            WHERE ac.annonce_id = :annonceId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $annonceCars = $results;
        }

        return $annonceCars;
    }

    /**
     * Create a reservation.
     */
    public function createReservation(string $user_id, string $annonce_id, DateTime $dateReservation): string
    {
        $reservationId = false;

        $data = [
            'user_id' => $user_id,
            'annonce_id' => $annonce_id,
            'dateReservation' => $dateReservation->format('Y-m-d H:i'),
        ];
        $sql = 'INSERT INTO reservations (user_id, annonce_id, dateReservation) VALUES (:user_id, :annonce_id, :dateReservation)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $reservationId = $this->connection->lastInsertId();
        }

        return $reservationId;
    }

    /**
     * Return all reservations.
     */
    public function getReservations(): array
    {
        $reservations = [];

        $sql = 'SELECT * FROM reservations';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservations = $results;
        }

        return $reservations;
    }

    /**
     * Update a reservation.
     */
    public function updateReservation(string $id, string $user_id, string $annonce_id, DateTime $dateReservation): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'user_id' => $user_id,
            'annonce_id' => $annonce_id,
            'dateReservation' => $dateReservation->format('Y-m-d H:i'),
        ];
        $sql = 'UPDATE reservations SET user_id = :user_id, annonce_id = :annonce_id, dateReservation = :dateReservation WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete a reservation.
     */
    public function deleteReservation(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM reservations WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    public function getReservationUsers(?string $reservationId, ?string $userId): array
    {
        $reservationUsers = [];
        if (!empty($userId)) {
            $data = [
                'userId' => $userId,
            ];
            $sql = '
                SELECT r.*
                FROM reservations as r
                WHERE r.user_id = :userId';
        } else {
            $data = [
                'reservationId' => $reservationId,
            ];
            $sql = '
                SELECT u.*
                FROM users as u
                LEFT JOIN reservations as r ON r.user_id = u.id
                WHERE r.id = :reservationId';
        }
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservationUsers = $results;
        }

        return $reservationUsers;
    }

    public function getReservationsAnnonces(?string $reservationId, ?string $annonceId): array
    {
        $reservationsAnnonces = [];
        if (!empty($annonceId)) {
            $data = [
                'annonceId' => $annonceId,
            ];
            $sql = '
                SELECT r.*
                FROM reservations as r
                WHERE r.annonce_id = :annonceId';
        } else {
            $data = [
                'reservationId' => $reservationId,
            ];
            $sql = '
                SELECT a.*
                FROM annonces as a
                LEFT JOIN reservations as r ON r.annonce_id = a.id
                WHERE r.id = :reservationId';
        }
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $reservationsAnnonces = $results;
        }

        return $reservationsAnnonces;
    }
}