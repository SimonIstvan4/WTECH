<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt</title>
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
            <a href="/" class="text-center text-[10px] uppercase font-bold hover:text-red-600">
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
        <a href="/kategoria" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            UNISEX <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
    </nav>
</header>

<main class="max-w-7xl mx-auto px-5 py-10">
    
    <section class="flex flex-col lg:grid lg:grid-cols-2 gap-12 mb-20 items-start">
        
        <div class="relative group w-full order-1">
            <div class="aspect-[4/5] md:aspect-square overflow-hidden bg-zinc-50">
                @php 
                    $mainImage = $product->images->where('Main', true)->first() ?? $product->images->first();
                @endphp
                
                @if($mainImage)
                    <img src="{{ asset('storage/' . $mainImage->Image_path) }}" 
                         alt="{{ $product->Name }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center text-zinc-300 font-bold uppercase tracking-widest italic">Bez fotky</div>
                @endif
            </div>
        </div>

        <div class="w-full order-2 lg:order-3">
            <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-4 italic">Ďalšie fotografie</p>
            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($product->images->where('Main', false) as $image)
                <div class="aspect-square overflow-hidden bg-zinc-100 group cursor-pointer border-2 border-transparent hover:border-red-600 transition-all">
                    <img src="{{ asset('storage/' . $image->Image_path) }}" 
                        alt="Detail" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                @endforeach
            </div>
        </div>

<form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form" class="flex flex-col justify-center pt-4 lg:pt-0 order-3 lg:order-2 lg:row-span-2">
    @csrf
    <p class="text-red-600 font-bold uppercase tracking-[0.3em] text-[10px] mb-2">
        {{ $product->brand->Name ?? 'Street Shoe' }}
    </p>
    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-4 italic leading-[0.9]">
        {{ $product->Name }}
    </h1>
    <p class="text-gray-500 text-lg mb-8 font-medium italic">
        {{ $product->category->Name ?? 'Voľnočasová obuv' }}
    </p>
    
    <p class="text-4xl font-black mb-10 tracking-tight">
        {{ number_format($product->Price, 2, ',', ' ') }} €
    </p>
        
    <div class="mb-6">
        <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-3 italic">Vyberte veľkosť</p>
        
        <input type="hidden" name="product_variant_id" id="selected_variant_id" value="">

        <div class="py-6 grid grid-cols-3 gap-3">
            @forelse($product->variants->sortBy('Size') as $variant)
                @php $isOutOfStock = $variant->Quantity <= 0; @endphp

                <div 
                    data-id="{{ $variant->id }}" 
                    class="size-option py-4 border rounded-lg text-center font-bold text-xs transition-all 
                    {{ $isOutOfStock 
                        ? 'border-zinc-100 bg-zinc-50 text-zinc-400 opacity-60' 
                        : 'border-zinc-200 hover:border-zinc-950 hover:bg-zinc-950 hover:text-white cursor-pointer text-zinc-900' 
                    }}"
                    @if(!$isOutOfStock) onclick="selectSize(this, {{ $variant->id }}, {{ $variant->available_stock }})" @endif
                >
                    EU {{ $variant->Size }}
                </div>
            @empty
                <p class="col-span-3 text-xs text-gray-400 italic">Tento produkt momentálne nemá dostupné veľkosti.</p>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-3 italic">Množstvo</p>
        <div class="w-32"> <input 
                type="number" 
                id="quantity-input" 
                name="quantity" 
                value="1" 
                min="1" 
                oninput="validateInput(this)"
                class="w-full text-center py-3 border border-zinc-200 rounded-lg text-lg font-black bg-zinc-50 outline-none focus:border-red-600 transition-colors"
            >
        </div>
    </div>

    <button type="submit" onclick="return validateSizeSelection()" class="w-full bg-zinc-950 text-white font-black py-6 rounded-full uppercase tracking-[0.2em] text-sm hover:bg-red-600 transition-all shadow-2xl active:scale-95 transform hover:-translate-y-1">
        Pridať do košíka
    </button>
</form>

    </section>

    <section class="mb-24">
        <h2 class="text-3xl font-black uppercase tracking-tighter mb-12 italic">Mohlo by sa ti páčiť</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-4 gap-y-10">
            @foreach($recommendedProducts as $rec)
            <div class="group relative">
                <a href="/produkt/{{ $rec->id }}" class="block">
                    <div class="relative aspect-[3/4] overflow-hidden bg-zinc-100 mb-4">
                        @php $recImg = $rec->images->where('Main', true)->first() ?? $rec->images->first(); @endphp
                        @if($recImg)
                            <img src="{{ asset('storage/' . $recImg->Image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @endif
                    </div>
                    <div class="px-1">
                        <p class="text-[9px] font-bold text-red-600 uppercase tracking-widest mb-1">{{ $rec->brand->Name ?? 'Street Shoe' }}</p>
                        <p class="font-bold text-sm uppercase truncate mb-1 italic group-hover:text-red-600 transition-colors">{{ $rec->Name }}</p>
                        <p class="text-gray-400 text-[10px] uppercase font-medium tracking-widest">{{ $rec->category->Name ?? 'Unisex' }}</p>
                        <p class="text-base font-black italic">{{ number_format($rec->Price, 2, ',', ' ') }} €</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="border-t border-zinc-100 pt-20 max-w-4xl">
        <h2 class="text-3xl font-black uppercase tracking-tighter mb-8 italic text-red-600">Detaily Produktu</h2>
        <div class="space-y-8 text-gray-600 leading-relaxed text-lg italic">
            <p>{{ $product->Description ?? 'Popis k tomuto modelu sa pripravuje. Každý krok v týchto teniskách je však zárukou štýlu a maximálneho pohodlia.' }}</p>
        </div>
    </section>

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

<script>
    function validateInput(input) {
        const variantId = document.getElementById('selected_variant_id').value;
        
        if (!variantId) {
            alert('Najprv si vyberte veľkosť!');
            input.value = 1;
            return;
        }

        let val = parseInt(input.value);

        if (isNaN(val)) return; 

        if (val < 1) {
            input.value = 1;
        } else if (val > currentStockLimit) {
            alert('Na sklade máme momentálne len ' + currentStockLimit + ' kusov.');
            input.value = currentStockLimit;
        }
    }

    let currentStockLimit = 0;

    function selectSize(element, variantId, stock) {
        document.querySelectorAll('.size-option').forEach(el => {
            el.classList.remove('bg-zinc-950', 'text-white');
            el.classList.add('border-zinc-200', 'text-zinc-900'); 
        });

        element.classList.remove('border-zinc-200', 'text-zinc-900');
        element.classList.add('bg-zinc-950', 'text-white');

        document.getElementById('selected_variant_id').value = variantId;
        currentStockLimit = stock; 

        // automaticka korekcia pre počet kusov
        const display = document.getElementById('quantity-display');
        const input = document.getElementById('quantity-input');
        let currentQty = parseInt(input.value);

        if (currentQty > currentStockLimit) {
            input.value = currentStockLimit;
            display.innerText = currentStockLimit;
        }
        console.log("Vybraný variant ID:", variantId, "Sklad:", currentStockLimit);
    }

    function validateSizeSelection() {
        const variantId = document.getElementById('selected_variant_id').value;
        const requestedQuantity = parseInt(document.getElementById('quantity-input').value);

        if (!variantId) {
            alert('Prosím, vyberte si veľkosť pred pridaním do košíka.');
            return false;
        }
        if (requestedQuantity > currentStockLimit) {
            alert('Bohužiaľ, nemôžete pridať viac kusov, než máme na sklade. Aktuálne dostupné: ' + currentStockLimit);
            return false;
        }
        if (currentStockLimit <= 0) {
            alert('Tento variant je momentálne vypredaný.');
            return false;
        }
        return true;
    }
</script>

</body>
</html>
