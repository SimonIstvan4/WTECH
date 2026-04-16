<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pridať produkt</title>
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
                <a href="/login" class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-red-500 hover:text-red-400 transition-colors">
                    <span>Odhlásiť sa</span>
                    <i class="fa fa-sign-out text-lg"></i>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-5 py-10">
        
        <div class="mb-8">
            <a href="/admin_zoznam" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-red-600 transition-colors flex items-center gap-2 mb-4">
                <i class="fa fa-arrow-left"></i> Späť na zoznam produktov
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter italic">Pridať nový produkt</h1>
        </div>

        <form id="productForm" class="bg-white rounded-[32px] shadow-sm border border-zinc-100 p-6 md:p-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Názov produktu *</label>
                        <input type="text" id="productName" required placeholder="napr. Nike Air Max 270" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Opis produktu *</label>
                        <textarea id="productDesc" required rows="5" placeholder="Detailný popis vlastností a materiálov..." class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-red-600 outline-none transition-all resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Cena (€) *</label>
                        <input type="number" step="0.01" required placeholder="0.00" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Počet kusov *</label>
                        <input type="number" step="0.01" required placeholder="0.00" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Značka *</label>
                        <select required class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="" disabled selected>Vyberte značku</option>
                            <option value="1">Nike</option>
                            <option value="2">Adidas</option>
                            <option value="3">Jordan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Kategória</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="everyone">Všetko</option>
                            <option value="men">Muži</option>
                            <option value="women">Ženy</option>
                            <option value="kids">Deti</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Sezóna</label>
                        <select class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="leto">Leto</option>
                            <option value="zima">Zima</option>
                            <option value="prechodne">Prechodné</option>
                            <option value="vsetko">Celoročné</option>
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
                <div class="mb-4 flex justify-between items-end">
                    <div>
                        <h2 class="text-xl font-black italic uppercase tracking-tighter">Fotografie produktu</h2>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4"> 
                    <div class="border-2 border-dashed border-zinc-300 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-400 hover:text-red-600 hover:border-red-600 hover:bg-red-50 transition-all group">
                        <i class="fa fa-camera text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Hlavná foto *</span>
                    </div>

                    <div class="border-2 border-dashed border-zinc-300 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-400 hover:text-red-600 hover:border-red-600 hover:bg-red-50 transition-all group">
                        <i class="fa fa-camera text-2xl mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-[10px] font-bold uppercase tracking-widest">Detail foto *</span>
                    </div>

                    <div class="border-2 border-dashed border-zinc-200 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-300 hover:text-zinc-600 hover:border-zinc-400 transition-all bg-zinc-50">
                        <i class="fa fa-plus text-xl mb-2"></i>
                    </div>
                    
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row justify-end gap-4">
                <a href="/admin_zoznam" class="px-8 py-4 rounded-full font-bold uppercase tracking-widest text-[11px] text-zinc-500 hover:bg-zinc-100 transition-colors text-center">
                    Zrušiť
                </a>
                <a href="/admin_zoznam">
                    <button type="button" class="bg-red-600 text-white px-10 py-4 rounded-full font-black uppercase tracking-widest text-[11px] hover:bg-red-700 transition-all shadow-lg flex items-center justify-center gap-2 transform hover:-translate-y-1">
                    <i class="fa fa-save"></i> Uložiť do databázy
                    </button>
                </a>

            </div>

        </form>
    </main>

</body>
</html>