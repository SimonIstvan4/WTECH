<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Order_item; 
use App\Models\ProductVariant;


class OrderController extends Controller
{
    public function processOrder(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'country' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'address' => 'required',
            'doprava' => 'required',
            'platba' => 'required',
        ]);

        $shippingPrice = 0;
        $shippingName = "";

        if ($request->doprava === 'kurier') {
            $shippingPrice = 3.50;
            $shippingName = "Doručenie na adresu";
        } elseif ($request->doprava === 'odberne_miesto') {
            $shippingPrice = 2.50;
            $shippingName = "Doručenie na odberné miesto";
        } else {
            $shippingPrice = 0;
            $shippingName = "Doručenie na predajňu";
        }

        $paymentPrice = ($request->platba === 'dobierka') ? 3.00 : 0;
        $paymentName = ($request->platba === 'dobierka') ? "Platba na dobierku" : "Platba kartou";

        session([
            'checkout_data' => $validated,
            'shipping_price' => $shippingPrice,
            'shipping_name' => $shippingName,
            'payment_price' => $paymentPrice,
            'payment_name' => $paymentName,
        ]);

        return redirect()->route('zhrnutie.show');
    }

    public function showSummary()
    {
        $cartItems = Order_item::with(['variant.product.images', 'variant.product.brand'])
            ->whereHas('order', function($q) {
                $q->where('Session_id', session()->getId())
                ->where('Paid', false);
            })
            ->get();

        $productsTotal = $cartItems->sum(function($item) {
            return $item->variant->product->Price * $item->Quantity;
        });

        return view('zhrnutie', compact('cartItems', 'productsTotal'));
    }

public function processPayment(Request $request)
{
    $order = Order::where('Session_id', session()->getId())
                  ->where('Paid', false)
                  ->first();

    if (!$order) {
        return redirect()->route('home');
    }

    DB::transaction(function () use ($order) {
        $items = Order_item::where('Order_id', $order->id)->get();

        foreach ($items as $item) {
            $variant = ProductVariant::find($item->Product_variant_id);
            if ($variant) {
                $variant->decrement('Quantity', $item->Quantity);
            }
        }

        $order->Paid = true;
        $order->save();
    });

    return view('potvrdenie_objednavky');
}
}