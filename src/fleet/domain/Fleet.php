<?php

declare(strict_types=1);


namespace App\fleet\domain;


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
        $this->vehicles[$registrationNumber] = $vehicle;
    }
}