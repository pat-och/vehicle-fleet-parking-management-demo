<?php

declare(strict_types=1);


namespace App\fleet\app;


use App\fleet\domain\Geolocation;

class ParkVehicleCommand
{

    private string $myUserId;
    private string $fooVehicleRegistrationNumber;
    private Geolocation $barLocation;

    public function __construct(string $myUserId, string $fooVehicleRegistrationNumber, Geolocation $barLocation)
    {
        $this->myUserId = $myUserId;
        $this->fooVehicleRegistrationNumber = $fooVehicleRegistrationNumber;
        $this->barLocation = $barLocation;
    }
}