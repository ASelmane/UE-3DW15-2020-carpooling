<?php

namespace App\Services;

use App\Entities\Car;

class CarsService
{
    /**
     * Create or update a car.
     */
    public function setCar(?string $id, string $marque, string $modele, string $couleur): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        if (empty($id)) {
            $isOk = $dataBaseService->createCar($marque, $modele, $couleur);
        } else {
            $isOk = $dataBaseService->updateCar($id, $marque, $modele, $couleur);
        }

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $dataBaseService = new DataBaseService();
        $carsDTO = $dataBaseService->getCars();
        if (!empty($carsDTO)) {
            foreach ($carsDTO as $carDTO) {
                $car = new Car();
                $car->setId($carDTO['id']);
                $car->setMarque($carDTO['marque']);
                $car->setModele($carDTO['modele']);
                $car->setCouleur($carDTO['couleur']);
                $cars[] = $car;
            }
        }

        return $cars;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCar($id);

        return $isOk;
    }
}
