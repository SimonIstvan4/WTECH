<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objednávka úspešná</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="m-0 font-sans bg-white text-zinc-900">

    <div class="bg-gradient-to-r from-red-800 via-red-600 to-red-800 text-white text-center py-2 text-[12px] tracking-[0.2em] uppercase font-medium">
        <i class="fa fa-check-circle" aria-hidden="true"></i>
        Vaša objednávka bola prijatá
    </div>

    <header class="bg-white px-[5%] py-4 border-b border-gray-100">
        <div class="max-w-[1600px] mx-auto flex justify-center items-center">
            
            <a href="/" class="text-3xl font-black uppercase tracking-tighter italic text-center">
                STREET <span class="text-red-600">SHOE</span>
            </a>
            
        </div>
    </header>

    <main class="w-full max-w-[800px] mx-auto px-5 py-20">
        
        <div class="bg-zinc-100 rounded-3xl p-10 md:p-16 shadow-inner border border-zinc-200 text-center">
            
            <h1 class="text-4xl font-black uppercase tracking-tighter mb-4 text-zinc-800">
                Ďakujeme za objednávku!
            </h1>
            
            <p class="text-xl font-bold text-zinc-600 mb-8">
                Vaša objednávka <span class="text-red-600">#20260324</span> bola úspešne vytvorená.
            </p>

            <div class="space-y-4 max-w-md mx-auto mb-12 text-zinc-500 font-medium leading-relaxed">
                <p>
                    Potvrdenie objednávky spolu s detailmi sme vám práve zaslali na vašu e-mailovú adresu.
                </p>
                <p>
                    Pre ďalšie informácie o vašej objdnávke sledujte e-mail.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
                <a href="/" class="bg-red-600 text-white px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-black transition-all shadow-xl hover:-translate-y-1 transform">
                    Späť na domovskú obrazovku
                </a>
            </div>
            
        </div>

    </main>

</body>
</html>