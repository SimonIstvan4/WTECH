<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zhrnutie objednávky</title>
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
            <div class="flex-1 text-center text-red-600 opacity-50">
                <i class="fa fa-shopping-cart text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Košík</span>
            </div>
            
            <div class="w-24 md:w-32 h-px bg-red-600 mb-6"></div>
            
            <div class="flex-1 text-center text-red-600 opacity-50">
                <i class="fa fa-truck text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Doprava</span>
            </div>
            
            <div class="w-24 md:w-32 h-px bg-red-600 mb-6"></div>
            
            <div class="flex-1 text-center text-red-600">
                <i class="fa fa-credit-card text-3xl block mb-1"></i>
                <span class="text-xs font-bold uppercase tracking-widest">Platba</span>
            </div>
        </div>
    </div>

    <main class="w-full max-w-[1200px] mx-auto px-5 py-8">
        
        <div class="bg-zinc-100 rounded-3xl p-8 md:p-12 shadow-inner border border-zinc-200">
            <h2 class="text-3xl font-black uppercase tracking-tighter mb-12 italic text-center text-zinc-800">Zhrnutie objednávky</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                
                <div class="flex items-start gap-5 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-24 h-24 bg-zinc-100 rounded-xl overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1">
                        <h3 class="font-bold text-sm uppercase">Nike</h3>
                        <p class="text-gray-600 text-xs">Air Max Plus III</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Veľkosť: 43 | Množstvo: 1</p>
                        <p class="font-black text-base pt-2 text-black">149,99 €</p>
                    </div>
                </div>

                <div class="flex items-start gap-5 bg-white p-5 rounded-2xl shadow-sm">
                    <div class="w-24 h-24 bg-zinc-100 rounded-xl overflow-hidden flex-shrink-0">
                        <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=200&q=80" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 space-y-1">
                        <h3 class="font-bold text-sm uppercase">Nike</h3>
                        <p class="text-gray-600 text-xs">Jordan 1 Retro High</p>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">Veľkosť: 44 | Množstvo: 1</p>
                        <p class="font-black text-base pt-2 text-black">185,00 €</p>
                    </div>
                </div>

            </div>

            <div class="h-px bg-zinc-200 w-full mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12 px-2">
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Zvolená doprava a platba:</span>
                        <div class="bg-white px-4 py-3 rounded-xl border border-zinc-200 font-bold text-sm uppercase mb-2">
                            Doručenie na adresu (+3.50€)
                        </div>
                        <div class="bg-white px-4 py-3 rounded-xl border border-zinc-200 font-bold text-sm uppercase">
                            Platba kartou (+0.00€)
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Dodacia adresa:</span>
                        <div class="bg-white px-4 py-3 rounded-xl border border-zinc-200 font-medium text-sm leading-relaxed">
                            <span class="font-bold block mb-1">Meno Priezvisko</span>
                            Hlavná 123, 811 01 Bratislava, Slovensko
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 border-t border-zinc-200 pt-10">
                <div class="text-center md:text-left">
                    <span class="text-xs font-bold text-zinc-500 uppercase tracking-widest block mb-1">Celková suma k úhrade</span>
                    <span class="text-4xl font-black text-black tracking-tighter">338,49 €</span>
                </div>
                
                <a href="/potvrdenie_objednavky" class="w-full md:w-auto">
                    <button class="w-full md:px-12 bg-red-600 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-all shadow-xl hover:-translate-y-1 transform">
                        Pokračovať s povinnosťou platby
                    </button>
                </a>
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
