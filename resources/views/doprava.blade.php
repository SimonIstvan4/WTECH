<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doprava a údaje</title>
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
            
            <div class="flex-1 text-center text-red-600">
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

    <main class="w-full max-w-[1200px] mx-auto px-5 py-8 grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
        
        <div class="bg-zinc-100 rounded-3xl p-8 shadow-inner border border-zinc-200 h-fit">
            <h2 class="text-2xl font-black uppercase tracking-tighter mb-8 italic text-zinc-800">Dodacie údaje</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">E-mail</label>
                    <input type="email" class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">Meno a priezvisko</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">Krajina</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium appearance-none">
                            <option>Slovensko</option>
                            <option>Česko</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">Mesto</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">PSČ</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1 ml-1">Ulica a číslo</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-zinc-200 outline-none focus:border-red-600 transition-colors bg-white font-medium">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-zinc-100 rounded-3xl p-8 border border-zinc-200 flex flex-col shadow-inner h-fit">
            
            <h2 class="text-2xl font-black uppercase tracking-tighter italic mb-6 text-center">Doprava</h2>
            <div class="space-y-3 mb-6">
                <label class="flex items-center justify-between p-3 bg-white border border-zinc-200 rounded-2xl cursor-pointer hover:border-red-600 transition-all group">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="doprava" class="w-4 h-4 accent-red-600">
                        <span class="font-bold text-[13px] uppercase tracking-wide">Doručenie na adresu</span>
                    </div>
                    <span class="font-black text-xs text-zinc-500">+3.50€</span>
                </label>

                <label class="flex items-center justify-between p-3 bg-white border border-zinc-200 rounded-2xl cursor-pointer hover:border-red-600 transition-all group">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="doprava" class="w-4 h-4 accent-red-600">
                        <span class="font-bold text-[13px] uppercase tracking-wide">Doručenie na predajňu</span>
                    </div>
                    <span class="font-black text-xs text-green-600">+0.00€</span>
                </label>

                <label class="flex items-center justify-between p-3 bg-white border border-zinc-200 rounded-2xl cursor-pointer hover:border-red-600 transition-all group">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="doprava" class="w-4 h-4 accent-red-600">
                        <span class="font-bold text-[13px] uppercase tracking-wide text-left leading-tight">Doručenie na odberné miesto <br></span>
                    </div>
                    <span class="font-black text-xs text-zinc-500">+2.50€</span>
                </label>
            </div>

            <h2 class="text-2xl font-black uppercase tracking-tighter italic mb-6 text-center">Platba</h2>
            <div class="space-y-3 mb-10">
                <label class="flex items-center justify-between p-3 bg-white border border-zinc-200 rounded-2xl cursor-pointer hover:border-red-600 transition-all group">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="platba" class="w-4 h-4 accent-red-600">
                        <span class="font-bold text-[13px] uppercase tracking-wide">Platba kartou</span>
                    </div>
                    <span class="font-black text-xs text-green-600">+0.00€</span>
                </label>

                <label class="flex items-center justify-between p-3 bg-white border border-zinc-200 rounded-2xl cursor-pointer hover:border-red-600 transition-all group">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="platba" class="w-4 h-4 accent-red-600">
                        <span class="font-bold text-[13px] uppercase tracking-wide">Platba na dobierku</span>
                    </div>
                    <span class="font-black text-xs text-zinc-500">+3.00€</span>
                </label>
            </div>

            <a href="/zhrnutie" class="block w-full">
                <button class="w-full bg-red-600 text-white py-4 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-black transition-all shadow-md hover:-translate-y-1 transform">
                    Pokračovať na zhrnutie objednávky
                </button>
            </a>
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
