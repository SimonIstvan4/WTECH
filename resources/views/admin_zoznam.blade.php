<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Správa produktov</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-0 font-sans bg-zinc-50 text-zinc-900">

    <header class="bg-zinc-950 text-white px-[5%] py-4 sticky top-0 z-50 shadow-md">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <div class="text-2xl font-black uppercase tracking-tighter italic flex items-center gap-3">
                <span>STREET <span class="text-red-600">SHOE</span></span>
                <span class="bg-red-600 text-white text-[10px] px-2 py-1 rounded-md tracking-widest not-italic">ADMIN</span>
            </div>
            
            <div class="flex items-center gap-8">
                <nav class="hidden md:flex gap-6 text-[11px] font-bold uppercase tracking-widest text-zinc-400">
                </nav>
                <div class="w-px h-6 bg-zinc-800"></div>
                <a href="#" 
                    onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();" 
                    class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-red-500 hover:text-red-400 transition-colors">
                    <span>Odhlásiť sa</span>
                    <i class="fa fa-sign-out text-lg"></i>
                </a>

                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-5 py-10">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter italic mb-1">Správa produktov</h1>
            </div>
            
            <a href="/admin_pridat" class="bg-red-600 text-white px-8 py-4 rounded-full font-black uppercase tracking-widest text-[11px] hover:bg-red-700 transition-all shadow-lg flex items-center gap-2 transform hover:-translate-y-1">
                <i class="fa fa-plus"></i> Nový produkt
            </a>
        </div>

        <div class="bg-white rounded-[32px] shadow-sm border border-zinc-100 p-6 md:p-8">
            
            <form action="{{ route('admin.products') }}" method="GET" class="bg-white p-6 rounded-2xl mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Vyhľadať produkt</label>
                        <div class="relative">
                            <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400 text-xs"></i>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Názov tenisky..." 
                                class="w-full bg-zinc-50 border-none rounded-xl py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-red-600/20 transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Kategória</label>
                        <select name="category" class="w-full bg-zinc-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-red-600/20 transition-all cursor-pointer appearance-none">
                            <option value="">Všetky kategórie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Značka</label>
                        <select name="brand" class="w-full bg-zinc-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-red-600/20 transition-all cursor-pointer appearance-none">
                            <option value="">Všetky značky</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3 items-end">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Veľkosť</label>
                            <select name="size" class="w-full bg-zinc-50 border-none rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-red-600/20 transition-all cursor-pointer appearance-none">
                                <option value="">Všetky</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size }}" {{ request('size') == $size ? 'selected' : '' }}>{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="bg-zinc-950 text-white rounded-xl py-3 font-bold text-xs uppercase tracking-widest hover:bg-red-600 transition-all shadow-lg shadow-zinc-200 active:scale-95">
                            Hľadať
                        </button>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="border-b-2 border-zinc-100 text-[10px] uppercase tracking-widest text-zinc-400">
                            <th class="pb-4 pl-2">Náhľad</th>
                            <th class="pb-4 pl-20 pr-40">Názov produktu</th>
                            <th class="pb-4 px-5">Značka</th>
                            <th class="pb-4 px-5">Kategória</th>
                            <th class="pb-4 px-5">Veľkosť</th>
                            <th class="pb-4 px-5">Cena</th>
                            <th class="pb-4 px-5 text-center">Skladom</th>
                            <th class="pb-4 px-5 text-right pr-4">Akcie</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach($variants as $variant)
                        <tr class="hover:bg-zinc-50/50 transition-colors group">
                            
                            <td class="py-5 pl-2">
                                <div class="w-12 h-12 rounded-xl bg-zinc-100 overflow-hidden border border-zinc-200">
                                    @if($variant->product->images->where('Main', true)->first())
                                        <img src="{{ asset('storage/' . $variant->product->images->where('Main', true)->first()->Image_path) }}" 
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[10px] text-zinc-400 font-bold uppercase tracking-widest">No img</div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-5 pl-20 pr-40">
                                <div class="text-sm font-black uppercase tracking-tighter italic">
                                    {{ $variant->product->Name }}
                                </div>
                            </td>
                            <td class="py-5 px-5">
                                <div class="text-[10px] font-bold text-red-600 uppercase tracking-widest">
                                    {{ $variant->product->brand->Name ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-5 px-5">
                                <div class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                                    {{ $variant->product->category->Name ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-5 px-5 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-zinc-100 text-zinc-900 text-[10px] font-bold uppercase tracking-wider">
                                    EU {{ $variant->Size }}
                                </span>
                            </td>
                            <td class="py-5 px-5 font-bold text-sm tracking-tight">
                                {{ number_format($variant->product->Price, 2, ',', ' ') }} €
                            </td>
                            <td class="py-5 px-5">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $variant->Quantity > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                    <span class="text-sm font-bold {{ $variant->Quantity > 0 ? 'text-zinc-900' : 'text-red-600' }}">
                                        {{ $variant->Quantity }} ks
                                    </span>
                                </div>
                            </td>

                            {{-- Akcie upraviť/odstrániť --}}
                            <td class="py-5 pr-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $variant->product->id) }}" 
                                    class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-zinc-600 hover:border-zinc-950 hover:text-zinc-950 transition-all shadow-sm">
                                        <i class="fa fa-pencil text-xs"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.variants.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('Naozaj chcete odstrániť tento variant?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-white border border-zinc-200 flex items-center justify-center text-red-600 hover:border-red-600 hover:bg-red-50 transition-all shadow-sm">
                                            <i class="fa fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex flex-col md:flex-row justify-between items-center border-t border-zinc-100 pt-6 gap-6">
                {{-- Info o zobrazení --}}
                <span class="text-xs font-bold text-zinc-400 uppercase tracking-widest">
                    Zobrazené {{ $variants->firstItem() }}-{{ $variants->lastItem() }} z {{ $variants->total() }}
                </span>
                
                <div class="flex flex-wrap justify-center gap-4 items-center">
                    {{-- Číselné stránkovanie --}}
                    <div class="flex gap-2 items-center">
                        @if ($variants->onFirstPage())
                            <span class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400 cursor-not-allowed">
                                <i class="fa fa-chevron-left text-xs"></i>
                            </span>
                        @else
                            <a href="{{ $variants->previousPageUrl() }}" class="w-10 h-10 rounded-full bg-zinc-100 hover:bg-zinc-200 transition-colors flex items-center justify-center text-zinc-900">
                                <i class="fa fa-chevron-left text-xs"></i>
                            </a>
                        @endif

                        @if($variants->currentPage() > 2)
                            <a href="{{ $variants->url(1) }}" class="w-10 h-10 rounded-full bg-zinc-100 hover:bg-zinc-200 transition-colors flex items-center justify-center font-bold text-xs">1</a>
                            @if($variants->currentPage() > 3)
                                <span class="text-zinc-400 px-1 italic">...</span>
                            @endif
                        @endif

                        @foreach (range(max(1, $variants->currentPage() - 1), min($variants->lastPage(), $variants->currentPage() + 1)) as $page)
                            @if ($page == $variants->currentPage())
                                <span class="w-10 h-10 rounded-full bg-zinc-950 text-white flex items-center justify-center font-bold text-xs shadow-lg shadow-zinc-200">{{ $page }}</span>
                            @else
                                <a href="{{ $variants->url($page) }}" class="w-10 h-10 rounded-full bg-zinc-100 hover:bg-zinc-200 transition-colors flex items-center justify-center font-bold text-xs">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($variants->currentPage() < $variants->lastPage() - 1)
                            @if($variants->currentPage() < $variants->lastPage() - 2)
                                <span class="text-zinc-400 px-1 italic">...</span>
                            @endif
                            <a href="{{ $variants->url($variants->lastPage()) }}" class="w-10 h-10 rounded-full bg-zinc-100 hover:bg-zinc-200 transition-colors flex items-center justify-center font-bold text-xs">{{ $variants->lastPage() }}</a>
                        @endif

                        @if ($variants->hasMorePages())
                            <a href="{{ $variants->nextPageUrl() }}" class="w-10 h-10 rounded-full bg-zinc-100 hover:bg-zinc-200 transition-colors flex items-center justify-center text-zinc-900">
                                <i class="fa fa-chevron-right text-xs"></i>
                            </a>
                        @else
                            <span class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400 cursor-not-allowed">
                                <i class="fa fa-chevron-right text-xs"></i>
                            </span>
                        @endif
                    </div>

                    {{-- skok na stranu --}}
                    <div x-data="{ 
                            jumpPage: {{ $variants->currentPage() }},
                            lastPage: {{ $variants->lastPage() }},
                            baseUrl: '{{ $variants->url('999') }}',
                            goToPage() {
                                if (this.jumpPage < 1) this.jumpPage = 1;
                                if (this.jumpPage > this.lastPage) this.jumpPage = this.lastPage;
                                window.location.href = this.baseUrl.replace('999', this.jumpPage);
                            }
                        }" 
                        class="flex items-center gap-2 bg-zinc-100 rounded-full px-2 py-1 border border-zinc-200">
                        <span class="text-[9px] font-black uppercase tracking-widest text-zinc-400 pl-2">Skok na</span>
                        <input type="number" x-model.number="jumpPage" min="1" :max="lastPage"@keydown.enter="goToPage()"
                            class="w-10 h-8 bg-white border-0 rounded-full text-center text-xs font-bold focus:ring-2 focus:ring-red-600 outline-none">
                        <button @click="goToPage()" 
                                class="w-8 h-8 rounded-full bg-zinc-950 text-white flex items-center justify-center hover:bg-red-600 transition-all">
                            <i class="fa fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
