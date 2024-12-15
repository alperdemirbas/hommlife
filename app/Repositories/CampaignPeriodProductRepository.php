<?php

namespace App\Repositories;

use App\Models\CampaignPeriodProducts;
use Illuminate\Database\Eloquent\Collection;

class CampaignPeriodProductRepository implements CampaignPeriodProductRepositoryInterface
{

    protected CampaignPeriodProducts $model;

    public function __construct(CampaignPeriodProducts $model)
    {
        $this->model = $model;
    }

    public function getAllProducts(): Collection
    {
        return $this->model->with(['period', 'product'])->get();
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

    public function getProductById(int $id)
    {
        $query = $this->model->newQuery()
            ->from("campaign_period_products")
            ->where('period_id', $id)
            ->get();
        return $query;
    }

    public function deleteProduct(int $id)
    {
        $product = $this->getProductById($id);
        return $product->delete();
    }

    public function productBelongToPeriod($id): Collection
    {
        return $this->model->newQuery()
            ->from("campaign_period_products")
            ->where('period_id', $id)
            ->get();
    }
}
