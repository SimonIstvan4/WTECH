<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        //novinky- posledné pridané
        $newProducts = Product::with(['brand', 'images', 'category'])
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        //Odporúčame- náhodné produkty
        $recommendedProducts = Product::with(['brand', 'images', 'category'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('homepage', compact('newProducts', 'recommendedProducts'));
    }
}