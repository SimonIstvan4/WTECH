<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage StreetShoe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-0 font-sans bg-white text-zinc-900 overflow-x-hidden">

    <div class="bg-gradient-to-r from-red-800 via-red-600 to-red-800 text-white text-center py-2 text-[12px] tracking-[0.2em] uppercase font-medium">
        <i class="fa fa-truck"></i>
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
                <a href="/" class="text-center text-[10px] uppercase font-bold text-red-600"><i class="fa fa-home text-[22px]"></i></a>
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

        <div class="w-full md:flex-[2] md:max-w-[500px] relative order-last md:order-none">
            <form action="/kategoria" method="GET">
                <input type="text" name="search" placeholder="Hľadať tenisky..." 
                    class="w-full py-2.5 pl-5 pr-12 rounded-full border-0 bg-zinc-100 outline-none focus:ring-2 focus:ring-red-600 transition-all text-sm font-medium">
                
                <button type="submit" class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 transition-colors border-0 bg-transparent cursor-pointer">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>

        <div class="hidden md:flex flex-1 justify-end gap-6 text-gray-700 shrink-0">
            <a href="/" class="text-center text-[10px] uppercase font-bold text-red-600">
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

    <nav class="flex justify-center gap-6 md:gap-12 pt-3 border-t border-gray-50 mt-4">
        <a href="/kategoria?gender=muzi" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            MUŽI <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria?gender=zeny" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            ŽENY <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria?gender=deti" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            DETI <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria?gender=unisex" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            UNISEX <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
    </nav>
</header>

    <div class="w-full h-[400px] mb-10 overflow-hidden bg-gray-200 shadow-lg">
        <img src="https://images.unsplash.com/photo-1624005340061-74f4968aacbb?q=80&w=1692&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
            class="w-full h-full object-cover">
    </div>

<section class="px-[5%] pb-10">
    <h2 class="mt-[75px] text-[32px] mb-5 font-bold">Novinky</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($newProducts as $product)
        <div class="group relative">
            <a href="/produkt/{{ $product->id }}" class="block">
                <div class="relative bg-zinc-100 aspect-square rounded-xl overflow-hidden mb-4">
                    @php $mainImg = $product->images->where('Main', true)->first() ?? $product->images->first(); @endphp
                    @if($mainImg)
                        <img src="{{ asset('storage/' . $mainImg->Image_path) }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-300 text-xs font-black uppercase italic">Bez fotky</div>
                    @endif
                </div>
                <div class="space-y-1">
                    <p class="font-bold text-[20px] tracking-tight group-hover:text-red-600 transition-colors">
                        {{ $product->brand->Name ?? 'Street Shoe' }}
                    </p>
                    <p class="text-gray-600 text-[16px]">{{ $product->Name }}</p>
                    <p class="text-gray-400 text-[10px] uppercase font-medium tracking-widest">
                        {{ $product->category->Name ?? 'Unisex' }}
                    </p>
                    <p class="font-black text-xl text-black mt-1">{{ number_format($product->Price, 2, ',', ' ') }} €</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <h2 class="mt-[75px] text-[32px] mb-5 font-bold uppercase tracking-tighter italic">Odporúčame</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($recommendedProducts as $product)
        <div class="group relative">
            <a href="/produkt/{{ $product->id }}" class="block">
                <div class="relative bg-zinc-100 aspect-square rounded-xl overflow-hidden mb-4">
                    @php 
                        $mainImg = $product->images->where('Main', true)->first() ?? $product->images->first(); 
                    @endphp
                    
                    @if($mainImg)
                        <img src="{{ asset('storage/' . $mainImg->Image_path) }}" 
                            alt="{{ $product->Name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-400 text-xs font-bold uppercase tracking-widest bg-zinc-100">
                            Bez obrázka
                        </div>
                    @endif
                </div>

                <div class="space-y-1">
                    <p class="font-bold text-[20px] tracking-tight group-hover:text-red-600 transition-colors">
                        {{ $product->brand->Name ?? 'Street Shoe' }}
                    </p>
                    <p class="text-gray-600 text-[16px] leading-tight">{{ $product->Name }}</p>
                    <p class="text-gray-400 text-[10px] uppercase font-medium tracking-widest">
                        {{ $product->category->Name ?? 'Unisex' }}
                    </p>
                    <div class="flex items-center gap-2 mt-1">
                        <p class="font-black text-xl text-black">
                            {{ number_format($product->Price, 2, ',', ' ') }} €
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>

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