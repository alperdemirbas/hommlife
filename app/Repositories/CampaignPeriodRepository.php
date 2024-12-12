<?php

namespace App\Repositories;

use App\Models\CampaignPeriod;
use Illuminate\Database\Eloquent\Collection;

class CampaignPeriodRepository implements CampaignPeriodRepositoryInterface
{
    protected $model;

    public function __construct(CampaignPeriod $campaignPeriod)
    {
        $this->model = $campaignPeriod;
    }

    public function getAllPeriods(): Collection
    {
        return $this->model->with('campaign')->get();
    }

    public function getPeriodById(int $id)
    {
        return $this->model->with('campaign')->findOrFail($id);
    }

    public function createPeriod(array $data)
    {
        return $this->model->create($data);
    }

    public function updatePeriod(int $id, array $data)
    {
        $period = $this->model->findOrFail($id);
        $period->update($data);
        return $period;
    }

    public function deletePeriod(int $id)
    {
        $period = $this->model->findOrFail($id);
        return $period->delete();
    }
}
