<?php

namespace App\Repositories;

use App\Models\CampaignPeriod;

interface CampaignPeriodRepositoryInterface
{
    public function getAllPeriods();
    public function getBetweenDates(int $id, $date);
    public function getPeriodById(int $id);
    public function createPeriod(array $data);
    public function updatePeriod(int $id, array $data);
    public function deletePeriod(int $id);
    public function periods(CampaignPeriod $periods);
}
