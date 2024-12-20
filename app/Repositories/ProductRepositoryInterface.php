<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}
