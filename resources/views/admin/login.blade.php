<!DOCTYPE html>
<html lang="es" class="h-full antialiased dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Admin — FREDOSIS ART</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex items-center justify-center p-6 bg-[#0c0c0e] text-[#ededeb] font-sans">
    <div class="w-full max-w-md bg-[#121214] border border-[#232326] rounded-2xl p-8 md:p-10 shadow-2xl space-y-8">
        <!-- Logo -->
        <div class="text-center space-y-2">
            <div class="w-14 h-14 rounded-full border border-[#d8c49d]/40 flex items-center justify-center bg-[#18181b] mx-auto shadow-inner">
                <span class="font-serif text-xl font-bold text-[#d8c49d]">FR</span>
            </div>
            <h1 class="font-serif text-2xl font-bold tracking-widest text-[#f5f5f3]">FREDOSIS</h1>
            <p class="text-xs text-[#8e8e93]">Portal Privado de Administración</p>
        </div>

        @if($errors->any())
            <div class="p-3.5 rounded-lg bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-1.5 text-xs">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Correo Electrónico</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', 'admin@fredosis.art') }}" 
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                    required 
                    autofocus
                >
            </div>

            <div class="space-y-1.5 text-xs">
                <label class="text-[#d8c49d] font-bold block uppercase tracking-wider">Contraseña</label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="••••••••" 
                    class="w-full bg-[#18181b] border border-[#2c2c30] rounded-xl p-3.5 text-white focus:outline-none focus:border-[#d8c49d]" 
                    required
                >
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-[#8e8e93] hover:text-white">
                    <input type="checkbox" name="remember" class="rounded bg-[#18181b] border-[#2c2c30] text-[#d8c49d] focus:ring-[#d8c49d]">
                    <span>Recordar sesión</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full py-3.5 px-4 rounded-xl bg-[#d8c49d] hover:bg-[#ebd7b1] text-black font-bold text-xs uppercase tracking-widest transition-all shadow-xl hover:scale-[1.01]"
            >
                Iniciar Sesión
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="{{ route('home') }}" class="text-xs text-[#666] hover:text-[#d8c49d] transition-colors">
                ← Volver al sitio público
            </a>
        </div>
    </div>
</body>
</html>
