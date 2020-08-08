<?php

declare(strict_types=1);


namespace App\fleet\infra;


class InMemoryFleetRepository implements FleetRepositoryInterface
{

    public function addFleet(string $userId): void
    {
        // TODO: Implement addFleet() method.
    }

    public function hasFooVehicleIntoFleet(string $vehicleRegistrationNumber, string $userId): bool
    {
        return true;
    }
}