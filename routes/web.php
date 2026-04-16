<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Models\Order;


Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    //nájdenie užívateľa v databáze
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        //prihlásenie sa do systému
        Auth::login($user);

        $sessionId = session()->getId();
        $guestOrder = Order::where('Session_id', $sessionId)->where('Paid', false)->first();

        if ($guestOrder) {
            $userOrder = Order::where('User_id', $user->id)->where('Paid', false)->first();

            if ($userOrder) {
                //ak mal používateľ v košíku veci už predtým tak sa spoja
                foreach ($guestOrder->items as $item) {
                    $existingItem = $userOrder->items()->where('Product_variant_id', $item->Product_variant_id)->first();
                    if ($existingItem) {
                        $existingItem->increment('Quantity', $item->Quantity);
                        $item->delete();
                    } else {
                        $item->update(['Order_id' => $userOrder->id]);
                    }
                }
                $guestOrder->delete();
            } else {
                $guestOrder->update(['User_id' => $user->id, 'Session_id' => null]);
            }
        }


        //kontrola či je admin
        if ($user->admin === true) {
            return redirect('/admin_zoznam');
        }

        //ak nie je admin
        return redirect('/');
    }

    return back()->with('error', 'Nesprávne údaje');
});

Route::post('/registration', function (Request $request) {
    $request->validate([
        'email' => 'required|email|unique:User,email',
        'password' => 'required|min:3|confirmed',
    ], [
       'email.unique' => 'Email už je zaregistrovaný',
       'password.min' => 'Heslo musí mať aspoň :min znaky',
       'password.confirmed' => 'Heslá sa nezhodujú', 
    ]);

    User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password), //uloženie hashu
        'admin' => false,
    ]);

    //prihlásenie sa po vytvorení účtu
    $user = User::where('email', $request->email)->first();
    Auth::login($user);

    return redirect('/')->with('success', 'Registrácia bola úspešná!');
});


Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


Route::get('/kosik', [CartController::class, 'show'])->name('cart.show');
Route::delete('/kosik/odstranit/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/kosik/pridat', [CartController::class, 'add'])->name('cart.add');
Route::patch('/kosik/upravit/{id}', [CartController::class, 'update'])->name('cart.update');

Route::get('/', [HomeController::class, 'index']);


Route::get('/registration', function () { return view('registration'); });
Route::get('/login', function () { return view('login'); });


Route::get('/kategoria', [CategoryController::class, 'index']);
Route::get('/produkt/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/doprava', function () { return view('doprava'); });
Route::get('/zhrnutie', function () { return view('zhrnutie'); });
Route::get('/potvrdenie_objednavky', function () { return view('potvrdenie_objednavky'); });

//admin časť
Route::get('/admin_zoznam', [ProductController::class, 'adminIndex'])->name('admin.products');
Route::get('/admin_pridat', [ProductController::class, 'adminCreate'])->name('admin.products.create');
Route::post('/admin_pridat', [ProductController::class, 'adminStore'])->name('admin.products.store');
Route::get('/admin_upravit', function () { return view('admin_upravit'); });
