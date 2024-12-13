<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected  Order $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function create(int $userId, array $data, float $total)
    {
        return $this->model->newQuery()->create([
            'user_id' => $userId,
            'cart' => json_encode($data),
            'total' => $total
        ]);
    }

    public function getBetweenDates(int $userId, $start, $end)
    {
        return $this->model->newQuery()
            ->whereBetween('created_at', [$start, $end])
            ->where('user_id', $userId)
            ->first();
    }
}
