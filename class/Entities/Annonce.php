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

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getLieuDepart(): string
    {
        return $this->lieuDepart;
    }

    public function setLieuDepart(string $lieuDepart): void
    {
        $this->lieuDepart = $lieuDepart;
    }

    public function getLieuArrivee(): string
    {
        return $this->lieuArrivee;
    }

    public function setLieuArrivee(string $lieuArrivee): void
    {
        $this->lieuArrivee = $lieuArrivee;
    }

    public function getDateDepart(): DateTime
    {
        return $this->dateDepart;
    }

    public function setDateDepart(DateTime $dateDepart): void
    {
        $this->dateDepart = $dateDepart;
    }

    public function getPlace(): string
    {
        return $this->place;
    }

    public function setPlace(string $place): void
    {
        $this->place = $place;
    }


}
