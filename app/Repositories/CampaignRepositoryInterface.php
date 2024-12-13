<?php

namespace App\Repositories;

interface CampaignRepositoryInterface
{
    public function getAllCampaigns();
    public function dateBetweenCampaigns($date);
    public function getCampaignById(int $id);
    public function createCampaign(array $data);
    public function updateCampaign(int $id, array $data);
    public function deleteCampaign(int $id);
}
