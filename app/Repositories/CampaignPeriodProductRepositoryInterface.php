<?php

namespace App\Repositories;

interface CampaignPeriodProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById(int $id);
    public function createProduct(array $data);
    public function updateProduct(int $id, array $data);
    public function deleteProduct(int $id);
}
