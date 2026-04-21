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
                <i class="fa fa-arrow-left"></i> Späť na zoznam produktov
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter italic">Pridať nový produkt</h1>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm" class="bg-white rounded-[32px] shadow-sm border border-zinc-100 p-6 md:p-10">
            @csrf
            @if ($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-2xl mb-8 text-xs font-bold uppercase tracking-widest border border-red-200">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-2"><i class="fa fa-exclamation-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Názov produktu *</label>
                        <input type="text" name="Name" id="productName" value="{{ old('Name') }}" required placeholder="napr. Air Max 1" 
                            class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Opis produktu</label>
                        <textarea name="Description" id="productDesc" required rows="3" placeholder="Detailný popis produktu..." 
                            class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-red-600 outline-none transition-all resize-none">{{ old('Description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Cena (€) *</label>
                        <input type="number" step="0.01" name="Price" value="{{ old('Price') }}" required placeholder="0.00" 
                            class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Značka *</label>
                        <select name="Brand_id" required class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="" disabled {{ old('Brand_id') ? '' : 'selected' }}>Vyberte značku</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('Brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Kategória *</label>
                        <select name="Category_id" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="" disabled {{ old('Category_id') ? '' : 'selected' }}>Vyberte kategóriu</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('Category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Sezóna *</label>
                        <select name="Season" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="leto" {{ old('Season') == 'leto' ? 'selected' : '' }}>Letné</option>
                            <option value="zima" {{ old('Season') == 'zima' ? 'selected' : '' }}>Zimné</option>
                            <option value="prechodne" {{ old('Season') == 'prechodne' ? 'selected' : '' }}>Prechodné</option>
                            <option value="vsetko" {{ old('Season') == 'vsetko' || !old('Season') ? 'selected' : '' }}>Celoročné</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="border-zinc-100 my-10">

            <div id="variants-wrapper" class="space-y-4">
                <h3 class="text-xs font-black uppercase tracking-widest italic mb-4">Varianty produktu (Veľkosti)</h3>
                
                <div id="variants-container" class="space-y-4">
                    <div class="variant-row grid grid-cols-1 md:grid-cols-2 gap-8 p-4 bg-zinc-50 rounded-2xl relative border border-transparent hover:border-zinc-200 transition-all">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Počet kusov *</label>
                            <input type="number" name="variants[0][quantity]" required placeholder="0" 
                                class="w-full bg-white border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all shadow-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Veľkosť (EU) *</label>
                            <input type="number" step="0.1" name="variants[0][size]" required placeholder="40" 
                                class="w-full bg-white border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="button" onclick="addVariantRow()" class="group flex flex-col items-center gap-2">
                        <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center shadow-lg shadow-red-200 group-hover:bg-red-700 group-hover:scale-110 transition-all cursor-pointer">
                            <i class="fa fa-plus text-white text-xl"></i>
                        </div>
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-400 group-hover:text-red-600 transition-colors">Pridať ďalšiu veľkosť</span>
                    </button>
                </div>
            </div>

            <hr class="border-zinc-100 my-10">

            <div class="space-y-8">
                <div class="bg-white p-8 rounded-3xl space-y-6">
                    <h3 class="text-xs font-black uppercase tracking-widest italic">Fotografie</h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Hlavná foto *</label>
                            <input type="file" name="main_image" id="main_img" class="hidden" accept="image/*" onchange="previewImage(this, 'preview-main')">
                            <label for="main_img" id="preview-main" class="border-2 border-dashed border-zinc-200 rounded-3xl h-48 flex flex-col items-center justify-center text-zinc-300 hover:text-red-600 hover:border-red-600 hover:bg-red-50 transition-all group cursor-pointer overflow-hidden">
                                <i class="fa fa-cloud-upload text-3xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-center px-4">Nahrať hlavnú foto</span>
                            </label>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Vedľajšia foto *</label>
                            <input type="file" name="side_image" id="side_img" class="hidden" accept="image/*" onchange="previewImage(this, 'preview-side')">
                            <label for="side_img" id="preview-side" class="border-2 border-dashed border-zinc-200 rounded-3xl h-48 flex flex-col items-center justify-center text-zinc-300 hover:text-red-600 hover:border-red-600 hover:bg-red-50 transition-all group cursor-pointer overflow-hidden">
                                <i class="fa fa-cloud-upload text-3xl mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest text-center px-4">Nahrať foto</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Galéria</label>
                        <div id="gallery-preview-container" class="grid grid-cols-4 gap-4">
                            {{-- Sem sa pridajú náhľady galérie --}}
                            <input type="file" name="gallery[]" id="gallery_imgs" class="hidden" multiple accept="image/*" onchange="previewGallery(this)">
                            <label for="gallery_imgs" class="border-2 border-dashed border-zinc-200 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-300 hover:text-zinc-600 hover:border-zinc-400 transition-all bg-zinc-50 cursor-pointer">
                                <i class="fa fa-plus text-xl"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex flex-col md:flex-row justify-end gap-4">
                <a href="{{ route('admin.products') }}" class="px-8 py-4 rounded-full font-bold uppercase tracking-widest text-[11px] text-zinc-500 hover:bg-zinc-100 transition-colors text-center">
                    Zrušiť
                </a>
                <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-full font-black uppercase tracking-widest text-[11px] hover:bg-red-700 transition-all shadow-lg flex items-center justify-center gap-3">
                    <span>Uložiť do databázy</span>
                    <i class="fa fa-check"></i>
                </button>
            </div>
        </form>
    </main>

    <script>
        let variantIndex = 1;

        function addVariantRow() {
            const container = document.getElementById('variants-container');
            const newRow = document.createElement('div');
            newRow.className = "variant-row grid grid-cols-1 md:grid-cols-2 gap-8 p-4 bg-zinc-50 rounded-2xl relative border border-transparent hover:border-zinc-200 transition-all mt-4 opacity-0 transform translate-y-2 transition-all duration-300";
            newRow.innerHTML = `
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Počet kusov *</label>
                    <input type="number" name="variants[${variantIndex}][quantity]" required placeholder="0" 
                        class="w-full bg-white border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all shadow-sm">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Veľkosť (EU) *</label>
                    <div class="flex gap-2">
                        <input type="number" step="0.1" name="variants[${variantIndex}][size]" required placeholder="40" 
                            class="w-full bg-white border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all shadow-sm">
                        <button type="button" onclick="this.closest('.variant-row').remove()" class="text-zinc-300 hover:text-red-600 transition-colors px-2">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            setTimeout(() => {
                newRow.classList.remove('opacity-0', 'translate-y-2');
            }, 10);
            variantIndex++;
        }

        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                       //nahradí vnútro labelu obrázkom
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    preview.classList.remove('border-dashed');
                    preview.classList.add('border-solid', 'border-red-600');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewGallery(input) {
            const container = document.getElementById('gallery-preview-container');
            const plusLabel = container.querySelector('label[for="gallery_imgs"]');
            
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = "h-32 rounded-2xl overflow-hidden border border-zinc-200";
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        container.insertBefore(div, plusLabel);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>
