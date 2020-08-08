<?php

declare(strict_types=1);

namespace Tests;

use App\fleet\app\RegisterVehicleCommand;
use App\fleet\app\RegisterVehicleCommandHandler;
use App\fleet\infra\InMemoryFleetRepository;
use PHPUnit\Framework\TestCase;

class RegisterVehicleCommandHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function iCanRegisterFooVehicleInToMyFleet()
    {
        /**
         * arrange
         */

        // given i
        $myUserId = 'abc';

        // given i have a fleet
        $fleetRepository = new InMemoryFleetRepository();
        $fleetRepository->addFleet($myUserId);

        // given a vehicle
        $fooVehicleRegistrationNumber = 'foo';

        /**
         * act
         */
        $registerVehicle = new RegisterVehicleCommandHandler($fleetRepository);
        $response = $registerVehicle(
            new RegisterVehicleCommand($myUserId, $fooVehicleRegistrationNumber)
        );


        /**
         * assert
         */
        $this->assertTrue(
            $fleetRepository->hasFooVehicleIntoFleet($fooVehicleRegistrationNumber, $myUserId)
        );
    }

}
