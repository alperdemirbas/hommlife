<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignPeriodProductRepositoryInterface;
use App\Repositories\CampaignPeriodRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CampaignPeriodProduct extends Controller
{

    protected array $data;
    protected CampaignPeriodProductRepositoryInterface $campaign_period_product_repository;
    protected CampaignPeriodRepositoryInterface $campaign_period_repository;

    protected CampaignRepositoryInterface $campaign_repository;

    protected ProductRepositoryInterface $product_repository;

    public function __construct(CampaignPeriodProductRepositoryInterface $campaignPeriodProductRepository,
                                CampaignPeriodRepositoryInterface        $campaign_period_repository,
                                ProductRepositoryInterface               $product_repository,
                                CampaignRepositoryInterface              $campaign_repository)
    {
        $this->campaign_period_product_repository = $campaignPeriodProductRepository;
        $this->campaign_period_repository = $campaign_period_repository;
        $this->product_repository = $product_repository;
        $this->campaign_repository = $campaign_repository;
    }

    public function index()
    {
        return redirect()->route('admin.campaigns.index')->with('success', 'Ürün eklendi.');
    }

    public function create(Request $request): View|Factory|Application
    {
        $this->data['campaign'] = $this->campaign_repository->getCampaignById((int)$request->get('campaign'));
        $this->data['period'] = $this->campaign_period_repository->getPeriodId($request->get('period'));
        $this->data['products'] = $this->product_repository->getAll();
        $this->data['added_products'] = $this->campaign_period_product_repository->productBelongToPeriod($request->get('period'));
        return view('admin.campaigns.periods.products.create', $this->data);
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
