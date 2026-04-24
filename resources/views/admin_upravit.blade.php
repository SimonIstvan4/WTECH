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
                <a href="#" 
                    onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();" 
                    class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-red-500 hover:text-red-400 transition-colors">
                    <span>Odhlásiť sa</span>
                    <i class="fa fa-sign-out text-lg"></i>
                </a>
                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-5 py-10">
        
        <div class="mb-8">
            <a href="{{ route('admin.products') }}" class="text-[11px] font-bold uppercase tracking-widest text-zinc-400 hover:text-red-600 transition-colors flex items-center gap-2 mb-4">
                <i class="fa fa-arrow-left"></i> Späť na zoznam
            </a>
            <h1 class="text-4xl font-black uppercase tracking-tighter italic">Upraviť produkt <span class="text-red-600">#{{ $product->id }}</span></h1>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[32px] shadow-sm border border-zinc-100 p-6 md:p-10">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Názov produktu</label>
                        <input type="text" name="Name" value="{{ old('Name', $product->Name) }}" required class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Opis produktu</label>
                        <textarea name="Description" rows="5" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm focus:ring-2 focus:ring-red-600 outline-none transition-all resize-none">{{ old('Description', $product->Description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Cena (€)</label>
                        <input type="number" name="Price" step="0.01" value="{{ old('Price', $product->Price) }}" required class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-black italic focus:ring-2 focus:ring-red-600 outline-none transition-all">
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Značka</label>
                        <select name="Brand_id" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->Brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Kategória</label>
                        <select name="Category_id" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->Category_id == $category->id ? 'selected' : '' }}>{{ $category->Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-zinc-400 mb-2">Sezóna</label>
                        <select name="Season" class="w-full bg-zinc-100 border-0 rounded-xl py-4 px-5 text-sm font-bold focus:ring-2 focus:ring-red-600 outline-none transition-all cursor-pointer">
                            <option value="Celoročné" {{ $product->Season == 'Celoročné' ? 'selected' : '' }}>Celoročné</option>
                            <option value="Leto" {{ $product->Season == 'Leto' ? 'selected' : '' }}>Leto</option>
                            <option value="Zima" {{ $product->Season == 'Zima' ? 'selected' : '' }}>Zima</option>
                        </select>
                    </div>
                </div>
            </div>

            <hr class="border-zinc-100 my-10">
            <div>
                <h2 class="text-xl font-black italic uppercase tracking-tighter mb-4">Dostupné veľkosti a sklad</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4 bg-zinc-50 p-6 rounded-3xl border border-zinc-100">
                    @foreach($product->variants->sortBy('Size') as $variant)
                        <div class="flex flex-col gap-1 bg-white p-3 rounded-2xl border border-zinc-200 shadow-sm">
                            <span class="text-[10px] font-bold text-zinc-400 uppercase">EU {{ $variant->Size }}</span>
                            <input type="hidden" name="variants[{{ $variant->id }}][id]" value="{{ $variant->id }}">
                            <input type="number" name="variants[{{ $variant->id }}][quantity]" min="0" value="{{ $variant->Quantity }}" class="w-full bg-zinc-100 border-0 rounded-lg py-2 px-3 text-sm font-black outline-none focus:ring-2 focus:ring-red-600 text-center">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- FOTOGRAFIE --}}
            <hr class="border-zinc-100 my-10">
            <div class="space-y-8">
                <div class="bg-white rounded-3xl space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xs font-black uppercase tracking-widest italic text-zinc-800">Fotografie produktu</h3>
                        <span class="text-[9px] font-bold text-red-600 uppercase bg-red-50 px-2 py-1 rounded">Povinná hlavná + aspoň 1 ďalšia</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Hlavná foto *</label>
                            <input type="file" name="main_image" id="main_img" class="hidden" accept="image/*" onchange="previewImage(this, 'preview-main')">
                            
                            @php $mainImg = $product->images->where('Main', true)->first(); @endphp
                            
                            <label for="main_img" id="preview-main" class="border-2 border-dashed border-zinc-200 rounded-3xl h-64 flex flex-col items-center justify-center text-zinc-300 hover:text-red-600 hover:border-red-600 hover:bg-red-50 transition-all group cursor-pointer overflow-hidden relative">
                                @if($mainImg)
                                    <img src="{{ asset('storage/' . $mainImg->Image_path) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                        <span class="text-white text-[10px] font-bold uppercase tracking-widest">Zmeniť hlavnú foto</span>
                                    </div>
                                @else
                                    <i class="fa fa-cloud-upload text-3xl mb-2"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-center px-4">Nahrať hlavnú foto</span>
                                @endif
                            </label>
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 pl-1">Ostatné fotografie *</label>
                            <div id="gallery-preview-container" class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                
                                @foreach($product->images->where('Main', false) as $image)
                                    <div class="relative border-2 border-zinc-100 rounded-2xl h-32 overflow-hidden group shadow-sm gallery-item" data-id="{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->Image_path) }}" class="w-full h-full object-cover">
                                        
                                        <div class="absolute inset-0 bg-red-600/90 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer text-white px-2 text-center" onclick="toggleDelete(this, '{{ $image->id }}')">
                                            <i class="fa fa-trash text-lg mb-1"></i>
                                            <span class="text-[8px] font-bold uppercase tracking-tighter">Kliknutím zmazať</span>
                                        </div>
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_check_{{ $image->id }}" class="hidden">
                                    </div>
                                @endforeach

                                <input type="file" name="gallery[]" id="gallery_imgs" class="hidden" multiple accept="image/*" onchange="previewGallery(this)">
                                <label for="gallery_imgs" class="border-2 border-dashed border-zinc-200 rounded-2xl h-32 flex flex-col items-center justify-center text-zinc-300 hover:text-red-600 hover:border-red-600 hover:bg-zinc-100 transition-all cursor-pointer">
                                    <i class="fa fa-plus text-xl"></i>
                                    <span class="text-[9px] font-bold uppercase mt-2">Pridať ďalšie</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex flex-col md:flex-row justify-end items-center gap-4">
                <a href="{{ route('admin.products') }}" class="px-8 py-4 rounded-full font-bold uppercase tracking-widest text-[11px] text-zinc-500 hover:bg-zinc-100 transition-colors text-center">
                    Zrušiť zmeny
                </a>

                <button type="submit" class="bg-zinc-950 text-white px-10 py-5 rounded-full font-black uppercase tracking-widest text-[11px] hover:bg-red-600 transition-all shadow-xl flex items-center justify-center gap-3 transform hover:-translate-y-1 active:scale-95">
                    <i class="fa fa-save"></i> Uložiť všetky zmeny
                </button>
            </div>

        </form>
    </main>

    <script>
        //funkcia označenie zmazania fotky
        function toggleDelete(element, id) {
            const checkbox = document.getElementById('delete_check_' + id);
            const parent = element.closest('.gallery-item');
            
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                parent.style.opacity = "0.3";
                parent.style.border = "2px solid red";
                element.querySelector('span').innerText = "Označené na zmazanie";
            } else {
                parent.style.opacity = "1";
                parent.style.border = "2px solid #f4f4f5";
                element.querySelector('span').innerText = "Kliknutím zmazať";
            }
        }

        function previewImage(input, targetId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const target = document.getElementById(targetId);
                reader.onload = e => {
                    target.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewGallery(input) {
            const container = document.getElementById('gallery-preview-container');
            const addButton = input.nextElementSibling;
            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const div = document.createElement('div');
                        div.className = "relative border-2 border-red-200 rounded-2xl h-32 overflow-hidden shadow-sm";
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover"><div class="absolute bottom-0 bg-red-600 text-white text-[7px] w-full text-center py-1 font-bold">NOVÁ</div>`;
                        container.insertBefore(div, addButton);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>

</body>
</html>
