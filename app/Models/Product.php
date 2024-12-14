<?php

namespace App\Models;

use App\Http\Controllers\Products;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'price',
        'image'
    ];

    /**
     * @return Collection
     * @description Ürünleri Listele
     */
    public function index(): Collection
    {
        return Product::all();
    }


    public function get($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * @return void
     * @description Admin Ürün Sil
     */
    public function deleteAdminProduct(): void
    {
        $this->delete();
    }

}
