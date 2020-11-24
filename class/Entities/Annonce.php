<?php

namespace App\Entities;

use DateTime;

class Annonce
{
    private $id;
    private $lieuDepart;
    private $lieuArrivee;
    private $dateDepart;
    private $place;
    private $prix;

    private $user;
    private $reservation;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getLieuDepart(): string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart)
    {
        $this->lieuDepart = $lieuDepart;

        return $this;
    }

    public function getLieuArrivee(): string
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(string $lieuArrivee)
    {
        $this->lieuArrivee = $lieuArrivee;

        return $this;
    }

    public function getDateDepart(): DateTime
    {
        return $this->dateDepart;
    }

    public function setDateDepart(DateTime $dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function setPlace(string $place)
    {
        $this->place = $place;

        return $this;
    }

    public function getPrix(): string
    {
        return $this->prix;
    }

    public function setPrix(string $prix)
    {
        $this->prix = $prix;

        return $this;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function setUser(array $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getReservation(): ?array
    {
        return $this->reservation;
    }

    public function setReservation(array $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }
}
