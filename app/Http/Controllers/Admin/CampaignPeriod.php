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
    protected CampaignPeriodRepositoryInterface $campaign_period;
    protected array $data;

    public function __construct(CampaignPeriodRepositoryInterface $campaign_period)
    {
        $this->campaign_period = $campaign_period;
    }

    public function index(): View|Factory|Application
    {
        $this->data['periods'] = $this->campaign_period->getAllPeriods();

        return view('admin.campaigns.periods.index', $this->data);
    }

    public function create(Request $request): View|Factory|Application
    {
        $id = (int)$request->query('campaign_id');
        $this->data['campaigns'] = $this->campaign_period->getCampaign($id);
        #$this->data['campaign'] = $this->data['campaigns']->first();
        $this->data['periods'] = $this->campaign_period->getAllPeriods();
        return view('admin.campaigns.periods.create', $this->data);
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

        $this->campaign_period->createPeriod($request->all());

        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla eklendi.');
    }

    public function edit($id): View|Factory|Application
    {
        $this->data['period'] = $this->campaign_period->getPeriodById($id);
        return view('admin.campaigns.periods.edit', $this->data);
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

        $this->campaign_period->updatePeriod($id, $request->all());
        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla güncellendi.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->campaign_period->deletePeriod($id);
        return redirect()->route('admin.campaigns.periods.index')->with('success', 'Dönem başarıyla silindi.');
    }
}
