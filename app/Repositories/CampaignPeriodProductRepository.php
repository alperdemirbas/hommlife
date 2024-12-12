<?php

namespace App\Repositories;

use App\Models\CampaignPeriodProducts;
use Illuminate\Database\Eloquent\Collection;

class CampaignPeriodProductRepository implements CampaignPeriodProductRepositoryInterface
{

    protected $model;
    public function __construct(CampaignPeriodProducts $model)
    {
        $this->model = $model;
    }

    public function getAllProducts(): Collection
    {
        return $this->model->with(['period','product'])->get();
    }

    public function getProductById(int $id)
    {
        return $this->model->with(['products','period'])->findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return $this->model->create($data);
    }

    public function updateProduct(int $id, array $data)
    {
        $product = $this->getProductById($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct(int $id)
    {
        $product = $this->getProductById($id);
        return $product->delete();
    }
}
