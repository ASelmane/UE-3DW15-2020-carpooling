<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['marque']) &&
            isset($_POST['modele']) &&
            isset($_POST['couleur'])) {
            // Create the Car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                null,
                $_POST['marque'],
                $_POST['modele'],
                $_POST['couleur']
            );
            if ($isOk) {
                $html = 'Voiture créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all Cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getMarque() . ' ' .
                $car->getModele() . ' ' .
                $car->getCouleur() .'<br />' ;
        }

        return $html;
    }

    /**
     * Update the Car.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['marque']) &&
            isset($_POST['modele']) &&
            isset($_POST['couleur'])) {
            // Update the Car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['id'],
                $_POST['marque'],
                $_POST['modele'],
                $_POST['couleur']
            );
            if ($isOk) {
                $html = 'Voiture mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete an Car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the Car :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['id']);
            if ($isOk) {
                $html = 'Voiture supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
}
