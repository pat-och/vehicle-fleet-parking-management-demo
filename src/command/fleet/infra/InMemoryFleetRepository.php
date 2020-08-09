<?php

declare(strict_types=1);


namespace App\command\fleet\infra;


use App\command\fleet\domain\Fleet;
use App\command\fleet\domain\Geolocation;
use App\command\fleet\domain\Vehicle;

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

    public function addVehicleToFleet(string $vehicleRegistrationNumber, string $userId, Geolocation $geolocation = null): void
    {
        $fleet = $this->fleets[$userId];
        $fleet->registerVehicle($vehicleRegistrationNumber, $geolocation);
    }

    public function getfooVehicleGeolocation(string $fooVehicleRegistrationNumber, string $myUserId, Geolocation $barLocation): ?Geolocation
    {
        return new Geolocation('43.300000', '5.400000');
    }


}