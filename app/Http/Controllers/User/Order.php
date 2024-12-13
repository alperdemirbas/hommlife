<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignPeriodRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function store(
        Request $request,
        OrderRepositoryInterface $order,
        CartRepositoryInterface $cart
    )
    {
        $userId = $request->user()->id;
        $carts = $cart->get($userId);
        $carts = $carts->map(function ($item) {
            if ($item->is_gift == true) {
                $item->product->price = 0;
            }
            return $item;
        });
        $total = $carts->sum(function($item) {
            return $item->product->price * $item->quantity;
        });
        $orderCreate = $order->create(
            $userId,
            $carts->toArray(),
            $total
        );
        if($orderCreate){
            $cart->deleteAll($userId);
        }
        return redirect()->route('carts.index');
    }
}
