<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignPeriodRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CampaignPeriod extends Controller
{
    protected CampaignPeriodRepositoryInterface $campaign;
    protected $data;

    public function __construct(CampaignPeriodRepositoryInterface $campaign)
    {
        $this->campaign = $campaign;
    }

    public function index(): View|Factory|Application
    {
        $this->data['periods'] = $this->campaign->getAllPeriods();
        return view('admin.campaigns.periods.index', $this->data);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.campaigns.periods.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'campaign_id' => 'required|exists:campaign,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'min_price' => 'required|numeric|min:0',
        ]);

        $this->campaign->createPeriod($request->all());

        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla eklendi.');
    }

    public function edit($id): View|Factory|Application
    {
        $period = $this->campaign->getPeriodById($id);
        return view('admin.campaigns.periods.edit', compact('period'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'campaign_id' => 'required|exists:campaign,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'min_price' => 'required|numeric|min:0',
        ]);

        $this->campaign->updatePeriod($id, $request->all());

        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla güncellendi.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->campaign->deletePeriod($id);
        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla silindi.');
    }
}
