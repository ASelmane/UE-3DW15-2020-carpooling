<?php

namespace App\Entities;


class Reservation
{
    private $id;
    private $idUser;
    private $idAnnonce;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getIdUser(): string
    {
        return $this->idUser;
    }

    public function setIdUser(string $idUser): void
    {
        $this->idUser = $idUser;
    }
    public function getIdAnnonce(): string
    {
        return $this->idAnnonce;
    }

    public function setIdAnnonce(string $idAnnonce): void
    {
        $this->idAnnonce = $idAnnonce;
    }

}
