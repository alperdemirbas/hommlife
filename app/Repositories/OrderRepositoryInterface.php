<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function create(int $userId, array $data, float $total);
    public function getBetweenDates(int $userId, $start, $end);
}
