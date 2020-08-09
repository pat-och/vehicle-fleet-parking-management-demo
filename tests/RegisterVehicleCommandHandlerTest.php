<?php

declare(strict_types=1);

namespace Tests;

use App\command\fleet\app\RegisterVehicleCommand;
use App\command\fleet\app\RegisterVehicleCommandHandler;
use App\command\fleet\app\RegisterVehicleCommandResponse;
use App\command\fleet\infra\InMemoryFleetRepository;
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
        $registerVehicle = new RegisterVehicleCommandHandler($fleetRepository, new RegisterVehicleCommandResponse());
        $registerVehicle(
            new RegisterVehicleCommand($myUserId, $fooVehicleRegistrationNumber)
        );

        /**
         * assert
         */
        $this->assertTrue(
            $fleetRepository->hasFooVehicleIntoFleet($fooVehicleRegistrationNumber, $myUserId)
        );
    }

    /**
     * @test
     */
    public function iCantRegisterTwiceFooVehicleInToMyFleet()
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

        /**
         * act
         */
        $registerVehicleCommandResponse = new RegisterVehicleCommandResponse();
        $registerVehicle = new RegisterVehicleCommandHandler($fleetRepository, $registerVehicleCommandResponse);
        $registerVehicle(
            new RegisterVehicleCommand($myUserId, $fooVehicleRegistrationNumber)
        );

        /**
         * assert
         */
        $this->assertEquals(
            'this vehicle has already been registered into your fleet',
            $registerVehicleCommandResponse->getError()
        );
    }

    /**
     * @test
     */
    public function sameVehicleCanBelongToMoreThanOneFleet()
    {
        /**
         * arrange
         */

        // given i
        $myUserId = 'abc';

        // given i have a fleet
        $fleetRepository = new InMemoryFleetRepository();
        $fleetRepository->addFleet($myUserId);

        // given the fleet of another user
        $anotherUserId = 'def';
        $fleetRepository->addFleet($anotherUserId);


        // given a registered vehicle into another user's fleet
        $fooVehicleRegistrationNumber = 'foo';
        $fleetRepository->addVehicleToFleet($fooVehicleRegistrationNumber, $anotherUserId);

        /**
         * act
         */
        $registerVehicle = new RegisterVehicleCommandHandler($fleetRepository, new RegisterVehicleCommandResponse());
        $registerVehicle(
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
