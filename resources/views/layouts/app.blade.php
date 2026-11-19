<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prologue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-gray-300 font-sans antialiased flex flex-col md:flex-row min-h-screen md:h-screen md:overflow-hidden">

    
    <aside class="w-full md:w-80 bg-gray-950 flex flex-col justify-between border-r border-gray-800 h-auto md:h-full">
        <div>
            
            <div class="p-6 text-center border-b border-gray-800">
                <h1 class="text-lg font-bold text-white">Web 2 előadás beadandó</h1>
            </div>

            
            <nav class="py-4 space-y-1">
                <a href="{{ route('home') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                    <span class="mr-3">🏠</span> Főoldal
                </a>
                <a href="{{ route('adatbazis') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                    <span class="mr-3">🗄️</span> Adatbázis
                </a>
                <a href="{{ route('kapcsolat') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                    <span class="mr-3">✉️</span> Kapcsolat
                </a>
                <a href="{{ route('diagram') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                    <span class="mr-3">📊</span> Diagram
                </a>
                <a href="{{ route('teszt') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                    <span class="mr-3">🧮</span> Teszt
                </a>
                @auth
                    <a href="{{ route('uzenetek') }}" class="flex items-center px-6 py-3 text-sm font-medium text-gray-300 hover:bg-gray-900 hover:text-white transition">
                        <span class="mr-3">💬</span> Üzenetek
                    </a>
                    @can('manage-sutik')
                    <a href="{{ route('sutik.index') }}" class="flex items-center px-6 py-3 text-sm font-medium text-indigo-400 hover:bg-gray-900 hover:text-indigo-300 transition">
                        <span class="mr-3">⚙️</span> Sütemények kezelése
                    </a>

                    <a href="{{ route('react') }}" class="flex items-center px-6 py-3 text-sm font-medium text-indigo-400 hover:bg-gray-900 hover:text-indigo-300 transition">
                        <span class="mr-3">⚽</span> React – Klubok
                    </a>
                @endcan
                @endauth
            </nav>
        </div>

        
        <div class="p-6 border-t border-gray-800">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 px-4 bg-teal-600 hover:bg-teal-500 text-white rounded-md text-sm font-semibold transition">
                        Kijelentkezés
                    </button>
                </form>
            @else
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}" class="w-1/2 text-center py-2 bg-gray-800 hover:bg-gray-700 text-white rounded-md text-sm">Bejelentkezés</a>
                    <a href="{{ route('register') }}" class="w-1/2 text-center py-2 bg-teal-600 hover:bg-teal-500 text-white rounded-md text-sm">Regisztráció</a>
                </div>
            @endauth
        </div>
    </aside>

    
    <div class="flex-1 flex flex-col min-w-0 md:h-full">
    <main class="flex-1 overflow-y-auto bg-gray-900 p-10">
        @yield('content')
    </main>

    <footer class="bg-gray-900 border-t border-gray-800 px-6 py-4 text-center text-sm text-gray-400">
        <p>Készítők: Nemes E. Lina (D4TUXP), Elek Dániel (XZN3PZ)</p>
    </footer>
</div>
</body>
</html>
