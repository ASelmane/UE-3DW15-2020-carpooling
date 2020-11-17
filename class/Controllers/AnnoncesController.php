<?php

namespace App\Controllers;

use App\Services\AnnoncesService;

class AnnoncesController
{
    /**
     * Return the html for the create action.
     */
    public function createAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['lieuDepart']) &&
            isset($_POST['lieuArrivee']) &&
            isset($_POST['dateDepart'])&&
            isset($_POST['place'])&&
            isset($_POST['prix'])) {
            // Create the Annonce :
            $annoncesService = new AnnoncesService();
            $isOk = $annoncesService->setAnnonce(
                null,
                $_POST['lieuDepart'],
                $_POST['lieuArrivee'],
                $_POST['dateDepart'],
                $_POST['place'],
                $_POST['prix']
            );
            if ($isOk) {
                $html = 'Annonce créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getAnnonces(): string
    {
        $html = '';

        // Get all Annonces :
        $annoncesService = new AnnoncesService();
        $annonces = $annoncesService->getAnnonces();

        // Get html :
        foreach ($annonces as $annonce) {
            $html .=
                '#' . $annonce->getId() . ' | ' .
                $annonce->getLieuDepart() . ' ==> ' .
                $annonce->getLieuArrivee() . ' | '.
                $annonce->getDateDepart()->format('H:i d-m-Y') . ' | '.
                $annonce->getPlace() . ' places disponible | '.
                $annonce->getPrix() . '€ <br />';
        }

        return $html;
    }

    /**
     * Update the Annonce.
     */
    public function updateAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['lieuDepart']) &&
            isset($_POST['lieuArrivee']) &&
            isset($_POST['dateDepart']) &&
            isset($_POST['place'])&&
            isset($_POST['prix'])) {
            // Update the Annonce :
            $annoncesService = new AnnoncesService();
            $isOk = $annoncesService->setAnnonce(
                $_POST['id'],
                $_POST['lieuDepart'],
                $_POST['lieuArrivee'],
                $_POST['dateDepart'],
                $_POST['place'],
                $_POST['prix']
            );
            if ($isOk) {
                $html = 'Annonce mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete an Annonce.
     */
    public function deleteAnnonce(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the Annonce :
            $annoncesService = new AnnoncesService();
            $isOk = $annoncesService->deleteAnnonce($_POST['id']);
            if ($isOk) {
                $html = 'Annonce supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}