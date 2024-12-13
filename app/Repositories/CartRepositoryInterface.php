<?php

namespace App\Repositories;

interface CartRepositoryInterface
{
    public function get(int $userId);
    public function checkGift(int $userId);

    public function create(array $fields);

    public function update(int $id, int $userId, array $fields);

    public function delete(int $id, int $userId);

    public function deleteAll(int $userId);
}
