<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{

    protected Cart $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    public function get(int $userId)
    {
        return $this->model->newQuery()
            ->with('product')
            ->where('user_id', $userId)
            ->get();
    }

    public function create(array $fields)
    {
        return $this->model->newQuery()
            ->create($fields);
    }

    public function checkGift(int $userId)
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->where('is_gift', 1)
            ->first();
    }

    public function update(int $id, int $userId, array $fields)
    {
        return $this->model->newQuery()
            ->where([
                'user_id' => $userId,
                'id' => $id
            ])
            ->update($fields);
    }

    public function delete(int $id, int $userId)
    {
        return $this->model->newQuery()
            ->where([
                'user_id' => $userId,
                'id' => $id
            ])
            ->delete();
    }

    public function deleteAll(int $userId)
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->delete();
    }
}
