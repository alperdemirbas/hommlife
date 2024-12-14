<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Products extends Controller
{
    protected array $data;
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(): View|Factory|Application
    {
        $this->data['products'] = $this->productRepository->getAll();
        return view('admin.products.index', $this->data);
    }


    public function edit(int $id): View|Factory|Application
    {
        $this->data['product'] = $this->productRepository->findById($id);
        return view('admin.products.edit', $this->data);
    }

    public function store()
    {
        $this->productRepository->create(request()->all());
        return redirect()->route('admin.products.index')->with('success', 'Ürün eklendi.');
    }

    public function create(): View|Factory|Application
    {
        return view('admin.products.create');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->productRepository->update($id, $request->all());
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect()->route('admin.products.index')->with('success','Ürün başarı ile silindi.');
    }

}
