<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order_item;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function adminCreate()
    {
        $categories = Category::orderBy('Name')->get();
        $brands = Brand::orderBy('Name')->get();
        
        return view('admin_pridat', compact('categories', 'brands'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Category_id' => 'required|exists:Category,id',
            'Brand_id' => 'required|exists:Brand,id',
            'variants' => 'required|array|min:1',
            'Season' => 'required|string',
            'main_image' => 'required|file|mimes:jpeg,png,jpg,webp,avif|max:5120',
            'side_image' => 'nullable|file|mimes:jpeg,png,jpg,webp,avif|max:5120',
            'gallery.*' => 'nullable|file|mimes:jpeg,png,jpg,webp,avif|max:5120'
        ]);

        //vytvorenie produktu
        $product = Product::create([
            'Name' => $request->Name,
            'Price' => $request->Price,
            'Category_id' => $request->Category_id,
            'Brand_id' => $request->Brand_id,
            'Season' => $request->Season,
            'Description' => $request->Description ?? '',
        ]);

        //uložnie variantov - rozne velkosti
        if ($request->has('variants')) {
            foreach ($request->variants as $variantData) {
                ProductVariant::create([
                    'Product_id' => $product->id,
                    'Size' => $variantData['size'],
                    'Quantity' => $variantData['quantity']
                ]);
            }
        }

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            ProductImage::create([
                'Product_id' => $product->id,
                'Image_path' => $path,
                'Main' => true
            ]);
        }

        if ($request->hasFile('side_image')) {
            $path = $request->file('side_image')->store('products', 'public');
            ProductImage::create([
                'Product_id' => $product->id,
                'Image_path' => $path,
                'Main' => false
            ]);
        }

        //dalšie fotky(ak sú)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file) {
                    $path = $file->store('products', 'public');
                    ProductImage::create([
                        'Product_id' => $product->id,
                        'Image_path' => $path,
                        'Main' => false
                    ]);
                }
            }
        }

        return redirect()->route('admin.products')->with('success', 'Produkt bol úspešne pridaný.');
    }

    public function adminIndex(Request $request)
    {
        $query = ProductVariant::with(['product.brand', 'product.category', 'product.images']);

        //plnotextové vyhladavanie
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('product', function($q) use ($searchTerm) {
                $q->where('Name', 'ILIKE', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('Category_id', $request->category);
            });
        }

        if ($request->filled('brand')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('Brand_id', $request->brand);
            });
        }

        if ($request->filled('size')) {
            $query->where('Size', $request->size);
        }
        $variants = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        $categories = Category::all(); 
        $brands = Brand::all();
        $sizes = ProductVariant::select('Size')->distinct()->orderBy('Size')->pluck('Size');

        return view('admin_zoznam', compact('variants', 'categories', 'brands', 'sizes'));
    }


    public function show($id)
    {
        $product = Product::with(['brand', 'category', 'images', 'variants'])->findOrFail($id);

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
