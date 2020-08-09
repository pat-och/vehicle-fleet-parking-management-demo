<?php

declare(strict_types=1);


namespace Tests;

use App\fleet\app\ParkVehicleCommand;
use App\fleet\app\ParkVehicleCommandHandler;
use App\fleet\app\ParkVehicleCommandResponse;
use App\fleet\domain\Geolocation;
use App\fleet\infra\InMemoryFleetRepository;
use PHPUnit\Framework\TestCase;

class ParkVehicleCommandHandlerTest extends TestCase
{

    /**
     * @test
     */
    public function successfullyParkFooVehicleAtBarLocation()
    {
        /**
         * arrange
         */

        // given i
        $myUserId = 'abc';

        // given i have a fleet
        $fleetRepository = new InMemoryFleetRepository();
        $fleetRepository->addFleet($myUserId);

        // given a registered vehicle
        $fooVehicleRegistrationNumber = 'foo';
        $fleetRepository->addVehicleToFleet($fooVehicleRegistrationNumber, $myUserId);

        // given location
        $barLocation = new Geolocation('43.300000', '5.400000');

        /**
         * act
         */
        $parkVehicleCommandResponse = new ParkVehicleCommandResponse();
        $parkVehicle = new ParkVehicleCommandHandler($fleetRepository, new ParkVehicleCommandResponse());
        $parkVehicle(
            new ParkVehicleCommand($myUserId, $fooVehicleRegistrationNumber, $barLocation)
        );

        $this->assertEquals(
            $barLocation,
            $fleetRepository->getfooVehicleGeolocation($fooVehicleRegistrationNumber, $myUserId, $barLocation)
        );
    }

    /**
     * @test
     */
    public function cantLocalizeMyVehicleToTheSameLocationTwoTimesInARow()
    {
        /**
         * arrange
         */

        // given i
        $myUserId = 'abc';

        // given i have a fleet
        $fleetRepository = new InMemoryFleetRepository();
        $fleetRepository->addFleet($myUserId);

        // given location
        $barLocation = new Geolocation('43.300000', '5.400000');

        // given a registered vehicle
        $fooVehicleRegistrationNumber = 'foo';
        $fleetRepository->addVehicleToFleet($fooVehicleRegistrationNumber, $myUserId, $barLocation);

        /**
         * act
         */
        $parkVehicleCommandResponse = new ParkVehicleCommandResponse();
        $parkVehicle = new ParkVehicleCommandHandler($fleetRepository, $parkVehicleCommandResponse);
        $parkVehicle(
            new ParkVehicleCommand($myUserId, $fooVehicleRegistrationNumber, $barLocation)
        );

        /**
         * assert
         */
        $this->assertEquals(
            'This vehicle is already parked at this location.',
            $parkVehicleCommandResponse->getError()
        );
    }
}
