<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected Product $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes): void
    {
        $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $product = $this->model->find($id);
        $product->update($attributes);
        return $product;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
