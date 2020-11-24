<?php

namespace App\Entities;

use DateTime;

class Reservation
{
    private $id;
    private $dateReservation;
    private $idUser;
    private $idAnnonce;
    private $user;
    private $annonce;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIdUser(): string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdAnnonce(): string
    {
        return $this->idAnnonce;
    }

    public function setIdAnnonce(string $idAnnonce)
    {
        $this->idAnnonce = $idAnnonce;

        return $this;
    }

    public function getDateReservation(): DateTime
    {
        return $this->dateReservation;
    }

    public function setDateReservation(DateTime $dateReservation)
    {
        $this->dateReservation = $dateReservation;

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
    
    public function getAnnonce(): ?array
    {
        return $this->annonce;
    }

    public function setAnnonce(array $annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

}
