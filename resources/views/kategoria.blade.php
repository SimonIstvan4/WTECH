<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategória</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                @if(request('gender'))
                    <input type="hidden" name="gender" value="{{ request('gender') }}">
                @endif

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Hľadať tenisky..." 
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
        <a href="/kategoria?gender=muzi" class="relative group text-[14px] font-bold uppercase {{ request('gender') == 'muzi' ? 'text-red-600' : 'text-gray-800 hover:text-red-600' }}">
            MUŽI 
            <span class="absolute -bottom-1 left-0 h-0.5 bg-red-600 transition-all {{ request('gender') == 'muzi' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
        </a>
        <a href="/kategoria?gender=zeny" class="relative group text-[14px] font-bold uppercase {{ request('gender') == 'zeny' ? 'text-red-600' : 'text-gray-800 hover:text-red-600' }}">
            ŽENY 
            <span class="absolute -bottom-1 left-0 h-0.5 bg-red-600 transition-all {{ request('gender') == 'zeny' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
        </a>
        <a href="/kategoria?gender=deti" class="relative group text-[14px] font-bold uppercase {{ request('gender') == 'deti' ? 'text-red-600' : 'text-gray-800 hover:text-red-600' }}">
            DETI 
            <span class="absolute -bottom-1 left-0 h-0.5 bg-red-600 transition-all {{ request('gender') == 'deti' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
        </a>
        <a href="/kategoria?gender=unisex" class="relative group text-[14px] font-bold uppercase {{ request('gender') == 'unisex' ? 'text-red-600' : 'text-gray-800 hover:text-red-600' }}">
            UNISEX 
            <span class="absolute -bottom-1 left-0 h-0.5 bg-red-600 transition-all {{ request('gender') == 'unisex' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
        </a>
    </nav>
</header>


<main class="max-w-7xl mx-auto px-[5%] py-10">
    <div class="flex flex-col lg:flex-row gap-10">
        
        <aside class="w-full lg:w-64 flex-shrink-0">
            <form action="{{ url()->current() }}" method="GET" class="flex flex-col gap-6 lg:gap-10">
                
                @if(request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                @if(request('gender'))
                    <input type="hidden" name="gender" value="{{ request('gender') }}">
                @endif

                <div class="w-full">
                    <h3 class="text-lg lg:text-xl font-bold mb-3 uppercase tracking-tighter border-b border-zinc-100 pb-2">Veľkosť (EU)</h3>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-[9px] text-zinc-400 uppercase font-bold">Od</span>
                            <input type="number" name="min_size" value="{{ request('min_size') }}" 
                                placeholder="{{ $absoluteMinSize }}" 
                                class="w-full bg-zinc-100 border-0 rounded-lg py-2.5 pl-7 pr-2 text-sm focus:ring-1 focus:ring-red-600 outline-none">
                        </div>
                        <div class="relative flex-1">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-[9px] text-zinc-400 uppercase font-bold">Do</span>
                            <input type="number" name="max_size" value="{{ request('max_size') }}" 
                                placeholder="{{ $absoluteMaxSize }}" 
                                class="w-full bg-zinc-100 border-0 rounded-lg py-2.5 pl-7 pr-2 text-sm focus:ring-1 focus:ring-red-600 outline-none">
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <h3 class="text-lg lg:text-xl font-bold mb-3 uppercase tracking-tighter border-b border-zinc-100 pb-2">Cena (€)</h3>
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-[9px] text-zinc-400 uppercase font-bold">Od</span>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" 
                                placeholder="{{ floor($absoluteMinPrice) }}" 
                                class="w-full bg-zinc-100 border-0 rounded-lg py-2.5 pl-7 pr-2 text-sm focus:ring-1 focus:ring-red-600 outline-none">
                        </div>
                        <div class="relative flex-1">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-[9px] text-zinc-400 uppercase font-bold">Do</span>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" 
                                placeholder="{{ ceil($absoluteMaxPrice) }}" 
                                class="w-full bg-zinc-100 border-0 rounded-lg py-2.5 pl-7 pr-2 text-sm focus:ring-1 focus:ring-red-600 outline-none">
                        </div>
                    </div>
                </div>

                <div class="border-b border-gray-100 pb-6" x-data="{ open: true }">
                    <h3 @click="open = !open" class="text-lg lg:text-xl font-bold mb-4 uppercase tracking-tighter border-b border-zinc-100 pb-2 flex justify-between items-center cursor-pointer group">
                        Značka
                        <i class="fa fa-chevron-down text-gray-400 group-hover:text-black transition-transform duration-300" 
                        :class="open ? '' : '-rotate-180'"></i>
                    </h3>
                    <div x-show="open" x-collapse class="space-y-3">
                        @foreach($brands as $brand)
                        <label class="flex items-center gap-3 group cursor-pointer">
                            <input type="checkbox" name="brands[]" value="{{ $brand->id }}" 
                                   {{ is_array(request('brands')) && in_array($brand->id, request('brands')) ? 'checked' : '' }}
                                   class="w-4 h-4 accent-red-600">
                            <span class="text-sm font-medium group-hover:text-red-600 transition-colors">{{ $brand->Name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="w-full" x-data="{ open: true }">
                    <h3 @click="open = !open" class="text-lg lg:text-xl font-bold mb-4 uppercase tracking-tighter border-b border-zinc-100 pb-2 flex justify-between items-center cursor-pointer group">
                        Sezóna
                        <i class="fa fa-chevron-down text-gray-400 group-hover:text-black transition-transform duration-300"
                        :class="open ? '' : '-rotate-180'"></i>
                    </h3>
                    <div x-show="open" x-collapse class="space-y-2.5 text-sm font-medium">
                        @php $seasons = ['Letné', 'Zimné', 'Prechodné', 'Celoročné']; @endphp
                        @foreach($seasons as $season)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" name="seasons[]" value="{{ $season }}" 
                                   {{ is_array(request('seasons')) && in_array($season, request('seasons')) ? 'checked' : '' }}
                                   class="w-4 h-4 accent-red-600">
                            <span class="group-hover:text-red-600 transition-colors">{{ $season }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="w-full bg-zinc-950 text-white font-black py-4 rounded-xl uppercase tracking-widest text-[11px] hover:bg-red-600 transition-all active:scale-95 shadow-lg mt-2">
                    Použiť filtre
                </button>

                <a href="{{ url()->current() }}" class="text-center text-[10px] uppercase font-bold text-gray-400 hover:text-red-600">Vymazať filtre</a>
            </form>
        </aside>

        <div class="flex-1">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-black uppercase tracking-tighter italic text-zinc-800">Vybrané produkty</h2>
                </div>

                <div class="relative flex items-center gap-2 bg-zinc-100 px-4 py-2 rounded-xl border border-zinc-200 w-full sm:w-auto">
                    <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400 whitespace-nowrap">
                        Zoradiť podľa:
                    </span>

                    <select onchange="location = this.value;" 
                            class="bg-transparent text-sm font-bold outline-none cursor-pointer appearance-none pr-8 w-full z-10">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'cheap']) }}" {{ request('sort') == 'cheap' ? 'selected' : '' }}>Najlacnejšie</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'expensive']) }}" {{ request('sort') == 'expensive' ? 'selected' : '' }}>Najdrahšie</option>
                    </select>

                    <i class="fa fa-chevron-down text-[10px] text-zinc-400 absolute right-4 pointer-events-none"></i>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @foreach($products as $product)
                <div class="group relative">
                    <a href="/produkt/{{ $product->id }}" class="flex flex-col h-full">
                        <div class="relative bg-zinc-100 aspect-square rounded-xl overflow-hidden mb-4"> 
                            @if($product->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $product->images->where('Main', true)->first()->Image_path) }}" alt="{{ $product->Name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-300 text-xs font-bold uppercase tracking-widest">Bez fotky</div>
                            @endif
                        </div>
                        
                        <div class="space-y-1">
                            <p class="font-bold text-sm md:text-base tracking-tight group-hover:text-red-600 transition-colors">{{ $product->brand ? $product->brand->Name : 'Neznáma značka' }}</p>
                            <p class="text-gray-600 text-xs truncate">{{ $product->Name }}</p>
                            <p class="text-gray-400 text-[10px] uppercase font-medium tracking-widest">{{ $product->category ? $product->category->Name : 'Unisex' }}</p>
                            <p class="font-black text-sm md:text-lg">{{ number_format($product->Price, 2, ',', ' ') }} €</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            @if($products->hasPages())
            <div class="mt-12 flex justify-center gap-2">
                @if ($products->onFirstPage())
                    <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-50 text-zinc-300 cursor-not-allowed"><i class="fa fa-angle-left"></i></span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-100 hover:bg-red-600 hover:text-white transition-colors"><i class="fa fa-angle-left"></i></a>
                @endif

                @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                    <a href="{{ $url }}" 
                       class="w-10 h-10 flex items-center justify-center rounded-lg font-bold text-sm transition-all {{ $page == $products->currentPage() ? 'bg-red-600 text-white shadow-lg' : 'bg-zinc-100 hover:bg-zinc-200 text-zinc-600' }}">
                        {{ $page }}
                    </a>
                @endforeach

                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-100 hover:bg-red-600 hover:text-white transition-colors"><i class="fa fa-angle-right"></i></a>
                @else
                    <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-zinc-50 text-zinc-300 cursor-not-allowed"><i class="fa fa-angle-right"></i></span>
                @endif
            </div>
            @endif
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


<script>
function sortProducts() {
    const grid = document.getElementById('products-grid');
    const select = document.getElementById('sort-select');
    const items = Array.from(grid.getElementsByClassName('product-item'));
    const order = select.value;

    items.sort((a, b) => {
        const priceA = parseFloat(a.getAttribute('data-price'));
        const priceB = parseFloat(b.getAttribute('data-price'));

        if (order === 'cheap') {
            return priceA - priceB;
        } else {
            return priceB - priceA;
        }
    });

    grid.innerHTML = '';
    items.forEach(item => grid.appendChild(item));
}

//hneď ako prídeme na stránku tak sa položky zoradia od najlacnejšej
document.addEventListener('DOMContentLoaded', sortProducts);
</script>

</body>
</html>