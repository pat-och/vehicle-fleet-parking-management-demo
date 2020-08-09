<?php

declare(strict_types=1);


namespace App\fleet\infra;


use App\fleet\domain\Fleet;
use App\fleet\domain\Geolocation;
use App\fleet\domain\Vehicle;

class InMemoryFleetRepository implements FleetRepositoryInterface
{

    private array $fleets;

    public function addFleet(string $userId): void
    {
        $this->fleets[$userId] = new Fleet($userId);
    }

    public function hasFooVehicleIntoFleet(string $vehicleRegistrationNumber, string $userId): bool
    {
        $fleet = $this->getFleet($userId);

        if (!isset($fleet)) {
            return false;
        }

        foreach ($fleet->getVehicles() as $vehicle) {
            if ($vehicleRegistrationNumber === $vehicle->getRegistrationNumber($vehicleRegistrationNumber)) {
                return true;
            }
        }

        return false;
    }

    public function getFleet(string $userId): ?Fleet
    {
        if (!array_key_exists($userId, $this->fleets)) {
            return null;
        }

        return $this->fleets[$userId];
    }

    public function addVehicleToFleet(string $vehicleRegistrationNumber, string $userId)
    {
        /** @var Fleet $fleet */
        $fleet = $this->fleets[$userId];
        $fleet->registerVehicle($vehicleRegistrationNumber);
    }

    public function getfooVehicleGeolocation(string $fooVehicleRegistrationNumber, string $myUserId, Geolocation $barLocation): ?Geolocation
    {
        return null;
    }


}