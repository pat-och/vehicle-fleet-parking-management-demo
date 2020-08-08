<?php

declare(strict_types=1);


namespace App\fleet\infra;


use App\fleet\domain\Fleet;

interface FleetRepositoryInterface
{
    public function addFleet(string $userId): void;
    public function getFleet(string $userId): ?Fleet;
}