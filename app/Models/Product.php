<?php

namespace App\Models;

use App\Http\Controllers\Products;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function find()
    {
        //
    }


    /**
     * @return void
     * @description Admin Ürün Oluştur
     */
    public function _______store(Request $request): Product
    {

    }

    /**
     * @return void
     * @description Admin Ürün Edit
     */
    public function editAdminProduct()
    {

    }

    /**
     * @return void
     * @description Admin Ürün Güncelle
     */
    public function updateAdminProduct($data): void
    {
        $this->update($data);
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
