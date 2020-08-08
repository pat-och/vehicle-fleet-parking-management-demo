<?php

declare(strict_types=1);


namespace App\fleet\domain;



use Exception;

class Fleet
{

    private string $userId;
    private array $vehicles = array();

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function registerVehicle(string $registrationNumber): void
    {
        $vehicle = new Vehicle($registrationNumber);

        if (array_key_exists($registrationNumber, $this->vehicles)) {
            throw new Exception('this vehicle has already been registered into your fleet');
        }

        $this->vehicles[$registrationNumber] = $vehicle;
    }
}