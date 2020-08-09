<?php

declare(strict_types=1);


namespace App\fleet\domain;


class Vehicle
{

    private string $registrationNumber;

    public function __construct(string $registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;
    }

    public function getRegistrationNumber(): string
    {
        return $this->registrationNumber;
    }

    public function addGeolocation(Geolocation $geolocation): void
    {
        $this->geolocation = $geolocation;
    }
}