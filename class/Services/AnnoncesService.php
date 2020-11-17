<?php

namespace App\Services;

use App\Entities\Annonce;
use DateTime;

class AnnoncesService
{
    /**
     * Create or update an Annonce.
     */
    public function setAnnonce(?string $id, string $lieuDepart, string $lieuArrivee, string $dateDepart, string $place, string $prix): bool
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
}
