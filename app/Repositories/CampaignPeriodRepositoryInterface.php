<?php

namespace App\Repositories;

interface CampaignPeriodRepositoryInterface
{
    public function getAllPeriods();
    public function getPeriodById(int $id);
    public function createPeriod(array $data);
    public function updatePeriod(int $id, array $data);
    public function deletePeriod(int $id);
}
