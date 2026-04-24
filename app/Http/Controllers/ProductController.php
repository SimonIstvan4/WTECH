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
            $file = $request->file('main_image');
    
            //získa pôvodný názov súboru - aby som ho tak vedel uloožiť do DB
            $originalName = $file->getClientOriginalName();
            $filename = $originalName;       //výsledok napr.  adidas_perf1.avif
            $path = $file->storeAs('products', $filename, 'public');

            ProductImage::create([
                'Product_id' => $product->id,
                'Image_path' => $filename,
                'Main' => true
            ]);
        }

        if ($request->hasFile('side_image')) {
            $file = $request->file('side_image');
    
            $originalName = $file->getClientOriginalName();
            $filename = $originalName;      
            $path = $file->storeAs('products', $filename, 'public');
            
            ProductImage::create([
                'Product_id' => $product->id,
                'Image_path' => $filename,
                'Main' => false
            ]);
        }

        //dalšie fotky(ak sú)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $key => $file) {
                $originalName = $file->getClientOriginalName();
                $filename = $originalName;
                $path = $file->storeAs('products', $filename, 'public');
                
                ProductImage::create([
                    'Product_id' => $product->id,
                    'Image_path' => $filename,
                    'Main' => false
                ]);
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

    public function adminVariantDestroy($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();

        return back()->with('success', 'Variant bol úspešne odstránený.');
    }

    //formulár na editovanie
    public function adminEdit($id)
    {
        $product = Product::with(['variants', 'images', 'category', 'brand'])->findOrFail($id);
        $categories = Category::orderBy('Name')->get();
        $brands = Brand::orderBy('Name')->get();
        
        return view('admin_upravit', compact('product', 'categories', 'brands'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $product = Product::with('images')->findOrFail($id);

        $request->validate([
            'Name' => 'required|string|max:255',
            'Price' => 'required|numeric',
            'Category_id' => 'required|exists:Category,id',
            'Brand_id' => 'required|exists:Brand,id',
        ]);

        $currentSecondary = $product->images->where('Main', false)->count();
        $toDelete = $request->has('delete_images') ? count($request->delete_images) : 0;
        $newCount = $request->hasFile('gallery') ? count($request->file('gallery')) : 0;

        if (($currentSecondary - $toDelete + $newCount) < 1) {
            return back()->withErrors(['gallery' => 'Produkt musí mať aspopping aspoň jednu ďalšiu fotku v galérii.']);
        }

        $product->update($request->only(['Name', 'Price', 'Description', 'Brand_id', 'Category_id', 'Season']));

        //update skladu
        if ($request->has('variants')) {
            foreach ($request->variants as $vData) {
                ProductVariant::where('id', $vData['id'])->update(['Quantity' => $vData['quantity']]);
            }
        }

        //nahrávanie novej hlavnej fotky
        if ($request->hasFile('main_image')) {
            ProductImage::where('Product_id', $product->id)->where('Main', true)->delete();
            
            $file = $request->file('main_image');
            $filename = $file->hashName(); 
            $file->storeAs('products', $filename, 'public');

            ProductImage::create([
                'Product_id' => $product->id,
                'Image_path' => 'products/' . $filename,
                'Main' => true
            ]);
        }

        //mazanie označených starých fotiek
        if ($request->has('delete_images')) {
            ProductImage::whereIn('id', $request->delete_images)->delete();
        }

        //nahranie nových vedlajších obrazkov
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $filename = $file->hashName();
                $file->storeAs('products', $filename, 'public');
                
                ProductImage::create([
                    'Product_id' => $product->id,
                    'Image_path' => 'products/' . $filename,
                    'Main' => false
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Produkt bol úspešne upravený.');
    }
}
