<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignPeriodProductRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CampaignPeriodProduct extends Controller
{

    protected $data;
    protected CampaignPeriodProductRepositoryInterface $campaign_period_product_repository;

    public function __construct(CampaignPeriodProductRepositoryInterface $campaignPeriodProductRepository)
    {
        $this->campaign_period_product_repository = $campaignPeriodProductRepository;
    }

    public function index(): View|Factory|Application
    {
        $this->data['products'] = $this->campaign_period_product_repository->getAllProducts();
        return view('admin.campaigns.periods.products.index', $this->data);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.campaigns.periods.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'period_id' => 'required|exists:campaign_periods,id',
            'product_id' => 'required|exists:products,id',
        ]);
        $this->campaign_period_product_repository->createProduct($request->all());
        return redirect()->route('admin.campaigns.periods.products.index')->with('success', 'Ürün eklendi.');
    }

    public function edit(int $id): View|Factory|Application
    {
        $this->data['product'] = $this->campaign_period_product_repository->getProductById($id);
        return view('admin.campaigns.periods.products.edit', $this->data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'period_id' => 'required|exists:campaign_periods,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $this->campaign_period_product_repository->updateProduct($id, $request->all());
        return redirect()->route('admin.campaigns.periods.products.index')->with('success', 'Ürün Başarı ile güncellendi.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->campaign_period_product_repository->deleteProduct($id);
        return redirect()->route('admin.campaigns.periods.products.index')->with('success', 'Ürün Başarı ile silindi.');
    }


}
