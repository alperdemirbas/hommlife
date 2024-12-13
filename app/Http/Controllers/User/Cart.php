<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignPeriodProductRepositoryInterface;
use App\Repositories\CampaignPeriodRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\Request;

class Cart extends Controller
{

    public function index(
        Request $request,
        CartRepositoryInterface $cart,
        CampaignRepositoryInterface $campaigns,
        CampaignPeriodRepositoryInterface $campaignPeriods,
        CampaignPeriodProductRepositoryInterface $campaignPeriodProducts,
        OrderRepositoryInterface $order,
    )
    {
        $userId = $request->user()->id;
        $createdAt = $request->user()->created_at;
        $campaign = $campaigns->dateBetweenCampaigns($createdAt);
        $data = $cart->get($request->user()->id);
        $total = $data->sum(function($item) {
            return !$item->is_gift ? $item->product->price * $item->quantity: 0;
        });
        $checkGift = $cart->checkGift($userId);
        if($campaign) {
            $period = $campaignPeriods->getBetweenDates($campaign->id, $createdAt);
            if($period) {
                $getOrder = $order->getBetweenDates($userId, $period->start_date, $period->end_date);
                $product = $campaignPeriodProducts->getProductById($campaign->id);
                if(
                    !$getOrder &&
                    $total >= $period->min_price
                ) {
                    if(!$checkGift) {
                        $cart->create([
                            'user_id' => $userId,
                            'product_id' => $product->product_id,
                            'quantity' => 1,
                            'is_gift' => true
                        ]);
                    }
                } else if($checkGift) {
                    $cart->delete($checkGift->id, $userId);
                }
            } else {
                if($checkGift) {
                    $cart->delete($checkGift->id, $userId);
                }
            }
        } else {
            if($checkGift) {
                $cart->delete($checkGift->id, $userId);
            }
        }
        return view('user.cart.index', compact('data', 'total'));
    }

    public function store(Request $request, CartRepositoryInterface $cart)
    {
        $cart->create($request->all());
        return redirect()->route('carts.index');
    }

    public function update(Request $request, CartRepositoryInterface $cart)
    {
        $cart->update(
            $request->route('cart'),
            $request->user()->id,
            ['quantity' => (int) $request->post('quantity')]
        );
        return redirect()->route('carts.index');
    }

    public function destroy(Request $request, CartRepositoryInterface $cart)
    {
        $cart->delete(
            $request->route('cart'),
            $request->user()->id
        );
        return redirect()->route('carts.index');
    }
}
