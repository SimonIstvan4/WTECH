<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order_item;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function adminIndex(Request $request)
    {
        // 1. Základný dopyt s eager loadingom
        $query = ProductVariant::with(['product.brand', 'product.category', 'product.images']);

        // 2. Fulltextové vyhľadávanie (v názve produktu)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('product', function($q) use ($searchTerm) {
                $q->where('Name', 'ILIKE', '%' . $searchTerm . '%');
            });
        }

        // 3. Filter podľa kategórie
        if ($request->filled('category')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('Category_id', $request->category);
            });
        }

        // 4. Filter podľa značky
        if ($request->filled('brand')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('Brand_id', $request->brand);
            });
        }

        // 5. Filter podľa veľkosti
        if ($request->filled('size')) {
            $query->where('Size', $request->size);
        }

        // 6. Vykonanie dopytu so stránkovaním (zachováme filtre v linkoch)
        $variants = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // 7. Načítanie dát pre dropdowny
        $categories = Category::all(); 
        $brands = Brand::all();
        $sizes = ProductVariant::select('Size')->distinct()->orderBy('Size')->pluck('Size');

        return view('admin_zoznam', compact('variants', 'categories', 'brands', 'sizes'));
    }


    public function show($id)
    {
        $product = Product::with(['brand', 'category', 'images', 'variants'])->findOrFail($id);

        //získaju sa ID-čka všetkých variantov tohto produktu
        $variantIds = $product->variants->pluck('id');

        //zistí sa čo je už v košiku
        $itemsInCart = Order_item::whereIn('Product_variant_id', $variantIds)
            ->select('Product_variant_id', \DB::raw('SUM("Quantity") as total_qty'))
            ->groupBy('Product_variant_id')
            ->pluck('total_qty', 'Product_variant_id');

        foreach ($product->variants as $variant) {
            $inCart = $itemsInCart[$variant->id] ?? 0;
            
            $variant->available_stock = max(0, $variant->Quantity - $inCart);
        }

        $recommendedProducts = Product::with(['brand', 'category', 'images'])
            ->where('id', '!=', $id)
            ->limit(5)
            ->get();

        return view('produkt', compact('product', 'recommendedProducts'));
    }
}