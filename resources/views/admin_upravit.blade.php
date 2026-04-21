<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upraviť produkt</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    <main class="max-w-4xl mx-auto px-5 py-10">
        
        <div class="mb-8">
            <a href="/admin_zoznam" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-red-600 transition-colors flex items-center gap-2 mb-4">
                <i class="fa fa-arrow-left"></i> Späť na zoznam
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter italic">Upraviť produkt <span class="text-red-600">#10045</span></h1>
        </div>

        <form class="bg-white rounded-[32px] shadow-sm border border-zinc-100 p-6 md:p-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Názov produktu</label>
                        <input type="text" value="Nike Air Max Pulse Roam" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Opis produktu</label>
                        <textarea rows="5" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-red-600 outline-none transition-all resize-none">Tento model kombinuje ikonický štýl Air Max s modernými prvkami pre maximálne pohodlie počas celého dňa.</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Cena (€)</label>
                        <input type="number" step="0.01" value="169.99" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Počet kusov *</label>
                        <input type="number" step="0.01" value="4" required placeholder="0.00" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Značka</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option selected>Nike</option>
                            <option>Adidas</option>
                            <option>Jordan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Kategória</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option selected>Muži</option>
                            <option>Ženy</option>
                            <option>Deti</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Sezóna</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option selected>Celoročné</option>
                            <option>Leto</option>
                            <option>Zima</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Typ</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="leto">Žiadny</option>
                            <option value="zima">Tenisky</option>
                            <option value="prechodne">Šľapky</option>
                            <option value="vsetko">Bežecká obuv</option>
                            <option value="vsetko">Turistická obuv</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="border-zinc-100 my-10">

            <div>
                <h2 class="text-xl font-black italic uppercase tracking-tighter mb-4">Fotografie produktu</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    
                    <div class="relative border-2 border-zinc-200 rounded-2xl h-32 overflow-hidden group transition-all hover:border-zinc-300 shadow-sm hover:shadow">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=200" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-2 text-center">
                            <i class="fa fa-check-circle text-green-600 text-2xl mb-1"></i>
                            <span class="text-[9px] font-bold uppercase text-zinc-600 mb-2">Hlavná nahraná</span>
                            <a href="#" class="text-red-600 hover:text-red-500 transition-colors p-1 rounded-md" title="Odstrániť fotografiu">
                                <i class="fa fa-trash text-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div class="relative border-2 border-zinc-200 rounded-2xl h-32 overflow-hidden group transition-all hover:border-zinc-300 shadow-sm hover:shadow">
                        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=200" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-2 text-center">
                            <i class="fa fa-check-circle text-green-600 text-2xl mb-1"></i>
                            <span class="text-[9px] font-bold uppercase text-zinc-600 mb-2">Detail nahraný</span>
                            <a href="#" class="text-red-600 hover:text-red-500 transition-colors p-1 rounded-md" title="Odstrániť fotografiu">
                                <i class="fa fa-trash text-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-zinc-200 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-300 bg-zinc-50 cursor-pointer hover:border-red-600 hover:text-red-600 hover:bg-zinc-100 transition-all">
                        <i class="fa fa-plus text-xl mb-2"></i>
                        <span class="text-[9px] font-bold uppercase tracking-widest text-zinc-400">Pridať</span>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row justify-end items-center gap-4">
                <a href="/admin_zoznam" class="px-8 py-4 rounded-full font-bold uppercase tracking-widest text-[11px] text-zinc-500 hover:bg-zinc-100 transition-colors text-center">
                    Zrušiť zmeny
                </a>

                <a href="/admin_zoznam">
                    <button type="button" class="bg-zinc-950 text-white px-10 py-4 rounded-full font-black uppercase tracking-widest text-[11px] hover:bg-zinc-800 transition-all shadow-lg flex items-center justify-center gap-2">
                        <i class="fa fa-save text-red-600"></i> Uložiť zmeny
                    </button>
                </a>
            </div>

        </form>
    </main>

</body>
</html>
