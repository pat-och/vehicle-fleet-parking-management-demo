<?php

declare(strict_types=1);


namespace App\fleet\app;


use App\fleet\infra\FleetRepositoryInterface;

class ParkVehicleCommandHandler
{

    private FleetRepositoryInterface $fleetRepository;

    public function __construct(FleetRepositoryInterface $fleetRepository)
    {
        $this->fleetRepository = $fleetRepository;
    }

    public function __invoke(ParkVehicleCommand $parkVehicleCommand): void
    {
        $fleet = $this->fleetRepository->getFleet($parkVehicleCommand->getUserId());
        $vehicle = $fleet->getVehicle($parkVehicleCommand->getVehicleRegistrationNumber());
        $vehicle->addGeoLocation($parkVehicleCommand->getGeoLocation());
    }
}