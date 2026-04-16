<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductVariant; 

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['brand', 'images', 'category']);

        if ($request->filled('gender')) {
            if ($request->gender === 'muzi') {
                $query->whereIn('Category_id', [2, 4]); 
            } elseif ($request->gender === 'zeny') {
                $query->whereIn('Category_id', [1, 4]);
            } elseif ($request->gender === 'deti') {
                $query->where('Category_id', 3);
            } elseif ($request->gender === 'unisex') {
                $query->where('Category_id', 4);
            }
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('Name', 'ILIKE', '%' . $searchTerm . '%');
        }

        if ($request->filled('brands')) {
            $query->whereIn('Brand_id', $request->brands);
        }

        if ($request->filled('seasons')) {
            $query->whereIn('Season', $request->seasons);
        }

        $rangeQuery = clone $query;
        $absoluteMinPrice = $rangeQuery->min('Price') ?? 0;
        $absoluteMaxPrice = $rangeQuery->max('Price') ?? 1000;
        $absoluteMinSize = \App\Models\ProductVariant::whereIn('Product_id', $rangeQuery->select('id'))->min('Size') ?? 35;
        $absoluteMaxSize = \App\Models\ProductVariant::whereIn('Product_id', $rangeQuery->select('id'))->max('Size') ?? 50;


        if ($request->filled('min_price')) {
            $query->where('Price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('Price', '<=', $request->max_price);
        }

        if ($request->filled('min_size') || $request->filled('max_size')) {
            $query->whereHas('variants', function($q) use ($request) {
                if ($request->filled('min_size')) {
                    $q->where('Size', '>=', $request->min_size);
                }
                if ($request->filled('max_size')) {
                    $q->where('Size', '<=', $request->max_size);
                }
            });
        }

        if ($request->sort == 'expensive') {
            $query->orderBy('Price', 'desc');
        } else {
            $query->orderBy('Price', 'asc');
        }

        $products = $query->paginate(20)->withQueryString();
        $brands = Brand::all();

        return view('kategoria', compact(
            'brands', 'products', 
            'absoluteMinPrice', 'absoluteMaxPrice', 
            'absoluteMinSize', 'absoluteMaxSize'
        ));
    }
}