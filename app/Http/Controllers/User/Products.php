<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{

    protected $data;

    public function index(Product $product): View|Factory|Application
    {
        $this->data['products'] = $product->all();
        return view('user.products.index', $this->data);
    }

    public function get(Product $product, $id): Factory|View|Application
    {
        $this->data['product'] = $product->get($id);
        return view('user.products.show', $this->data);
    }

}
