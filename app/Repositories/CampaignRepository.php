<?php

namespace App\Repositories;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;

class CampaignRepository implements CampaignRepositoryInterface
{
    protected Campaign $model;

    public function __construct(Campaign $campaign)
    {
        $this->model = $campaign;
    }

    public function getAllCampaigns(): Collection
    {
        return $this->model->all();
    }

    public function getCampaignById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function createCampaign(array $data)
    {
        return $this->model->create($data);
    }

    public function updateCampaign(int $id, array $data)
    {
        $campaign = $this->model->findOrFail($id);
        $campaign->update($data);
        return $campaign;
    }

    public function deleteCampaign(int $id)
    {

        $campaign = $this->model->findOrFail($id);
        return $campaign->delete();
    }
}
