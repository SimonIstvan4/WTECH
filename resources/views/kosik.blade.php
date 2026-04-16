<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Košík</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-0 font-sans bg-white text-zinc-900">

    <div class="bg-gradient-to-r from-red-800 via-red-600 to-red-800 text-white text-center py-2 text-[12px] tracking-[0.2em] uppercase font-medium">
        <i class="fa fa-truck" aria-hidden="true"></i>
        <span class="font-bold">Doprava zadarmo</span> pri nákupe nad 120 €
    </div>

<header class="bg-white px-[5%] py-4 border-b border-gray-100 top-0 z-50">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center w-full md:w-auto md:flex-1">
            
            <div class="text-2xl sm:text-3xl font-black uppercase tracking-tighter italic shrink-0 flex flex-row md:flex-col lg:flex-row lg:gap-2 leading-none">
                <span>STREET</span>
                <span class="text-red-600 ml-1 md:ml-0 lg:ml-0">SHOE</span>
            </div>

            <div class="flex md:hidden gap-4 text-gray-700 shrink-0">
                <a href="/" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-home text-[22px]"></i></a>
                @auth
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="text-center text-[10px] uppercase font-bold hover:text-red-600">
                        <i class="fa fa-sign-out text-[22px]"></i>
                    </a>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @endauth
                @guest
                    <a href="/login" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-user-circle-o text-[22px]"></i></a>
                @endguest
                <a href="#" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-heart-o text-[22px]"></i></a>
                <a href="/kosik" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-shopping-cart text-[22px]"></i></a>
            </div>
        </div>

        <div class="hidden md:flex flex-1 justify-end gap-6 text-gray-700 shrink-0">
            <a href="/" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                <i class="fa fa-home text-[22px] block mb-0.5"></i> Domov
            </a>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors cursor-pointer bg-transparent border-0 p-0">
                        <i class="fa fa-sign-out text-[22px] block mb-0.5"></i> Odhlásiť sa
                    </button>
                </form>
            @endauth
            @guest
                <a href="/login" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                    <i class="fa fa-user-circle-o text-[22px] block mb-0.5"></i> Prihlásiť sa
                </a>
            @endguest
            <a href="#" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                <i class="fa fa-heart-o text-[22px] block mb-0.5"></i> Obľúbené
            </a>
            <a href="/kosik" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                <i class="fa fa-shopping-cart text-[22px] block mb-0.5"></i> Košík
            </a>
        </div>
    </div>
</header>

    <div class="max-w-4xl mx-auto my-12 px-5">
        <div class="flex items-center justify-between text-center gap-1 pointer-events-none select-none">
            <div class="flex-1 text-center text-red-600">
                <i class="fa fa-shopping-cart text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Košík</span>
            </div>
            
            <div class="w-24 md:w-32 h-px bg-red-600 mb-6"></div>
            
            <div class="flex-1 text-center text-gray-400">
                <i class="fa fa-truck text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Doprava</span>
            </div>
            
            <div class="w-24 md:w-32 h-px bg-gray-200 mb-6"></div>
            
            <div class="flex-1 text-center text-gray-400">
                <i class="fa fa-credit-card text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Platba</span>
            </div>
        </div>
    </div>

<main class="w-full max-w-[1600px] mx-auto px-5 py-8 grid grid-cols-1 xl:grid-cols-3 gap-10 items-start">
    
    <div class="xl:col-span-2 bg-zinc-100 rounded-3xl p-8 shadow-inner border border-zinc-200">
        <h2 class="text-3xl font-black uppercase tracking-tighter mb-10 italic text-center text-zinc-800">Váš nákupný košík</h2>
        
        <div class="space-y-8">
            @forelse($items as $item)
                @php 
                    $product = $item->variant->product;
                    $image = $product->images->where('Main', true)->first() ?? $product->images->first();
                @endphp
                
                <div class="flex flex-col md:flex-row items-center gap-6 bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                    <div class="w-40 aspect-square rounded-xl overflow-hidden bg-zinc-100">
                        @if($image)
                            <img src="{{ asset('storage/' . $image->Image_path) }}" alt="{{ $product->Name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-zinc-300 font-bold uppercase text-[10px]">Bez fotky</div>
                        @endif
                    </div>
                    
                    <div class="flex-1 space-y-2 text-center md:text-left">
                        <h3 class="font-bold text-lg uppercase">{{ $product->brand->Name ?? 'Street Shoe' }}</h3>
                        <p class="text-gray-600 text-base leading-tight">{{ $product->Name }}</p>
                        <p class="text-gray-400 text-[10px] uppercase font-bold tracking-widest">Veľkosť: {{ $item->variant->Size }}</p>
                        <p class="font-black text-xl text-black mt-3">{{ number_format($product->Price, 2, ',', ' ') }} €</p>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
                        <div class="w-24">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Množstvo</label>
                            
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input 
                                    type="number" 
                                    name="quantity" 
                                    value="{{ $item->Quantity }}" 
                                    min="1" 
                                    onchange="this.form.submit()"
                                    class="w-full text-center py-2 border border-zinc-200 rounded-lg text-sm font-bold bg-zinc-50 outline-none focus:border-red-600 transition-colors"
                                >
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="md:self-end">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors p-2">
                            <i class="fa fa-trash-o text-2xl"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div class="bg-white p-12 rounded-2xl text-center border border-zinc-200">
                    <i class="fa fa-shopping-basket text-4xl text-zinc-200 mb-4 block"></i>
                    <p class="text-zinc-500 font-bold uppercase tracking-widest">Váš košík je momentálne prázdny</p>
                    <a href="/kategoria" class="inline-block mt-6 text-red-600 font-black uppercase text-xs hover:underline">Začať nakupovať</a>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-3xl p-8 border border-zinc-200 flex flex-col shadow-sm h-fit">
        <h2 class="text-2xl font-black uppercase tracking-tighter italic text-center mb-10">Zhrnutie</h2>

        <div class="flex justify-between items-end mb-10 border-t border-zinc-100 pt-5">
            <span class="text-base font-bold text-zinc-600 uppercase tracking-widest">Celková suma</span>
            <span class="text-3xl font-black text-black">{{ number_format($total ?? 0, 2, ',', ' ') }} €</span>
        </div>

        @if($items->count() > 0)
            <a href="/doprava" class="block w-full">
                <button class="w-full bg-red-600 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-all shadow-xl hover:-translate-y-1 mb-8 transform">
                    Pokračovať k výberu dopravy
                </button>
            </a>
        @endif
        
        <div class="space-y-3 pt-6 border-t border-zinc-100 text-zinc-500 text-xs font-medium">
            <div class="flex items-center gap-2"><i class="fa fa-truck text-red-600"></i> Doprava zadarmo pri nákupe nad 120 €</div>
            <div class="flex items-center gap-2"><i class="fa fa-refresh text-red-600"></i> Vrátenie zadarmo do 30 dní</div>
            <div class="flex items-center gap-2"><i class="fa fa-check text-red-600"></i> Záruka kvality</div>
        </div>
    </div>

</main>

@guest
    <footer class="bg-zinc-950 py-[50px] px-5 text-center mt-[75px] text-white">
        <h2 class="text-4xl font-black mb-3 tracking-tighter uppercase">
            UŠETRI <span class="text-red-600">10 €</span> Z NÁKUPU
        </h2>
        <p class="text-gray-400 text-lg mb-5 max-w-md mx-auto">
            Pridaj sa do klubu a tvoja prvá zľava ťa čaká hneď po registrácii.
        </p>
        
        <div class="mb-10 flex flex-col justify-center items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-red-600">
                    <i class="fa fa-money"></i>
                </div>
                <span class="text-sm font-bold uppercase tracking-wider text-gray-200">10 € voucher</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full border border-gray-800 flex items-center justify-center text-red-600">
                    <i class="fa fa-heart-o"></i>
                </div>
                <span class="text-sm font-bold uppercase tracking-wider text-gray-200">Vlastný wishlist</span>
            </div>
        </div>

        <a href="/registration" 
        class="inline-block bg-white text-black px-12 py-4 font-black text-sm uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all transform hover:-translate-y-1">
            Získať výhody teraz
        </a>
    </footer>
@endguest

@auth
    <footer class="bg-zinc-950 text-white py-20 px-5 text-center mt-5">
        <div class="text-3xl font-black uppercase tracking-tighter italic mb-2">
            STREET <span class="text-red-600">SHOE</span>
        </div>
        <p class="text-zinc-500 text-xs uppercase tracking-[0.3em] font-bold">
            Vaša najlepšia možnosť
        </p>
    </footer>
@endauth

</body>
</html>