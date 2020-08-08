<?php

declare(strict_types=1);


namespace App\fleet\app;


use App\fleet\infra\FleetRepositoryInterface;

class RegisterVehicleCommandHandler
{

    private FleetRepositoryInterface $fleetRepository;

    public function __construct(FleetRepositoryInterface $fleetRepository)
    {
        $this->fleetRepository = $fleetRepository;
    }

    public function __invoke(RegisterVehicleCommand $registerVehicleCommand): void
    {

    }
}