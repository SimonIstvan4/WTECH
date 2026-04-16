<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_variant_id' => 'required|exists:Product_variant,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $sessionId = Session::getId();

        //hladanie existujúceho košíka
        $order = Order::where('Paid', false)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('User_id', $userId);
                } else {
                    $query->where('Session_id', $sessionId);
                }
            })->first();

        //vytvorenie nového ak neexistuje
        if (!$order) {
            $order = Order::create([
                'User_id' => $userId,
                'Session_id' => $userId ? null : $sessionId,
                'Paid' => false
            ]);
        }

        //pridanie položky/ zvýšenie množstva
        $item = Order_item::where('Order_id', $order->id)
            ->where('Product_variant_id', $request->product_variant_id)
            ->first();

        if ($item) {
            $item->increment('Quantity', $request->quantity);
        } else {
            Order_item::create([
                'Order_id' => $order->id,
                'Product_variant_id' => $request->product_variant_id,
                'Quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Produkt bol pridaný do košíka.');
    }

    public function show()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        $order = Order::where('Paid', false)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('User_id', $userId);
                } else {
                    $query->where('Session_id', $sessionId);
                }
            })
            ->with(['items.variant.product.images', 'items.variant.product.brand'])
            ->first();

        $items = $order ? $order->items : collect();
        $total = $items->sum(function($item) {
            return $item->variant->product->Price * $item->Quantity;
        });

        return view('kosik', compact('items', 'total'));
    }

    public function remove($id)
    {
        $item = Order_item::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Položka bola odstránená.');
    }

    public function update(Request $request, $id)
    {
        $item = Order_item::findOrFail($id);

        $variant = Productvariant::findOrFail($item->Product_variant_id);
        
        //validacia aby nebolo možné dať číslo <1
        $request->validate([
        'quantity' => [
            'required',
            'integer',
            'min:1',
            'max:' . $variant->Quantity //obmedzenie podľa počtu na sklade
            ],
        ]);

        $item->update([
            'Quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Množstvo bolo upravené.');
    }
}