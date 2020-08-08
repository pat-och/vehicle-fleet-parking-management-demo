<?php

declare(strict_types=1);


namespace App\fleet\infra;


interface FleetRepositoryInterface
{
    public function addFleet(string $userId): void;
}