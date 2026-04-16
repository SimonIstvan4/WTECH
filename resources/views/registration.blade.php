<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrácia</title>
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
                <a href="/" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-home text-[22px]"></i></a>
                <a href="/login" class="text-center text-[10px] uppercase font-bold text-red-600"><i class="fa fa-user-circle-o text-[22px]"></i></a>
                <a href="#" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-heart-o text-[22px]"></i></a>
                <a href="/kosik" class="text-center text-[10px] uppercase font-bold"><i class="fa fa-shopping-cart text-[22px]"></i></a>
            </div>
        </div>

        <div class="w-full md:flex-[2] md:max-w-[500px] relative order-last md:order-none">
            <input type="text" placeholder="Hľadať tenisky..." 
                   class="w-full py-2.5 pl-5 pr-12 rounded-full border-0 bg-zinc-100 outline-none focus:ring-2 focus:ring-red-600 transition-all text-sm font-medium">
            <i class="fa fa-search absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 cursor-pointer"></i>
        </div>

        <div class="hidden md:flex flex-1 justify-end gap-6 text-gray-700 shrink-0">
            <a href="/" class="text-center text-[10px] uppercase font-bold hover:text-red-600">
                <i class="fa fa-home text-[22px] block mb-0.5"></i> Domov
            </a>
            <a href="/login" class="text-center text-[10px] uppercase font-bold text-red-600">
                <i class="fa fa-user-circle-o text-[22px] block mb-0.5"></i> Prihlásiť sa
            </a>
            <a href="#" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                <i class="fa fa-heart-o text-[22px] block mb-0.5"></i> Obľúbené
            </a>
            <a href="/kosik" class="text-center text-[10px] uppercase font-bold hover:text-red-600 transition-colors">
                <i class="fa fa-shopping-cart text-[22px] block mb-0.5"></i> Košík
            </a>
        </div>
    </div>

    <nav class="flex justify-center gap-6 md:gap-12 pt-3 border-t border-gray-50 mt-4">
        <a href="/kategoria" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            MUŽI <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            ŽENY <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            DETI <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
        <a href="/kategoria" class="relative group text-[14px] font-bold uppercase text-gray-800 hover:text-red-600">
            UNISEX <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
        </a>
    </nav>
</header>

    <main class="flex min-h-[85vh] w-full">
        
        <div class="hidden lg:block flex-1 bg-zinc-200 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1678802910315-b1bf6ca9f6a6?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8c25lYWtlcnMlMjBzaG9lc3xlbnwwfDF8MHx8fDA%3D');"></div>

        <div class="flex-[2] bg-white flex justify-center items-center p-6 md:p-10">
            <div class="bg-zinc-100 p-8 md:p-12 rounded-3xl w-full max-w-lg text-center shadow-sm">
                
                <h1 class="text-4xl font-black mb-8 uppercase tracking-tighter">Registrácia</h1>
                
                    <form action="/registration" method="POST">
                        @csrf 

                        <div class="text-left mb-5">
                            <label class="block text-sm font-bold uppercase tracking-wider mb-2 text-gray-800">E-mail
                            @error('email')
                                <span class="text-red-600 text-xs font-bold mt-1 ml-2">{{ $message }} </span>
                            @enderror</label>
                            <input type="email" name="email" required
                                class="w-full p-4 rounded-full border-0 bg-white shadow-sm outline-none focus:ring-2 focus:ring-red-600 transition-all text-sm">
                        </div>

                        <div class="text-left mb-5">
                            <label class="block text-sm font-bold uppercase tracking-wider mb-2 text-gray-800">Heslo
                            @error('password')
                                <span class="text-red-600 text-xs font-bold mt-1 ml-2">{{ $message }} </span>
                            @enderror</label>
                            </label>
                            <div class="relative">
                                <input type="password" name="password" required
                                    class="w-full p-4 rounded-full border-0 bg-white shadow-sm outline-none focus:ring-2 focus:ring-red-600 transition-all pr-12 text-sm">
                                <i class="fa fa-eye absolute right-5 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-red-600 transition-colors text-lg" 
                                onclick="let i = this.previousElementSibling; i.type = i.type === 'password' ? 'text' : 'password'; this.classList.toggle('fa-eye-slash')">
                                </i>
                            </div>
                        </div>

                        <div class="text-left mb-8">
                            <label class="block text-sm font-bold uppercase tracking-wider mb-2 text-gray-800">Heslo znovu</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" required
                                    class="w-full p-4 rounded-full border-0 bg-white shadow-sm outline-none focus:ring-2 focus:ring-red-600 transition-all pr-12 text-sm">
                                <i class="fa fa-eye absolute right-5 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-red-600 transition-colors text-lg" 
                                onclick="let i = this.previousElementSibling; i.type = i.type === 'password' ? 'text' : 'password'; this.classList.toggle('fa-eye-slash')">
                                </i>
                            </div>
                        </div>

                        <button type="submit" class="bg-zinc-950 text-white font-bold py-4 px-12 rounded-full w-full hover:bg-red-600 transition-all uppercase tracking-widest text-sm shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Registrovať sa
                        </button>
                    </form>

                <p class="mt-6 text-gray-500 text-sm">
                    Už máte účet? 
                    <a href="/login" class="font-bold text-zinc-950 uppercase tracking-wider ml-1 hover:text-red-600 transition-colors underline decoration-2 underline-offset-4">
                        Prihláste sa
                    </a>
                </p>

            </div>
        </div>

        <div class="hidden lg:block flex-1 bg-zinc-200 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1619448889339-f5714e1c7eae?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTh8fHNuZWFrZXJzJTIwc2hvZXN8ZW58MHwxfDB8fHww');"></div>
        
    </main>

</body>
</html>
