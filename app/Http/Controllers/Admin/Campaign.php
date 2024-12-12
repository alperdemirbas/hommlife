<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Campaign extends Controller
{
    protected $campaignRepository;
    protected $data;

    public function __construct(CampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function index(): View|Factory|Application
    {
        $this->data['campaigns'] = $this->campaignRepository->getAllCampaigns();


        return view('admin.campaigns.index', $this->data);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string|max:500',
        ]);

        $this->campaignRepository->createCampaign($request->all());

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanya başarıyla eklendi.');
    }

    public function edit(int $id)
    {
        $this->data['campaign'] = $this->campaignRepository->getCampaignById($id);
        return view('admin.campaigns.edit', $this->data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|string|max:500',
        ]);

        $this->campaignRepository->updateCampaign($id, $request->all());

        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanya başarıyla güncellendi.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->campaignRepository->deleteCampaign($id);
        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanya başarıyla silindi.');
    }
}
