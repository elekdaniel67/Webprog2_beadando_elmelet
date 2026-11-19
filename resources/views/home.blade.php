@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <section class="bg-gray-800 border border-gray-700 rounded-2xl p-8 md:p-12">
            <p class="text-teal-400 font-semibold uppercase tracking-widest text-sm mb-4">
                Üdvözlünk nálunk
            </p>

            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Fedezd fel süteményeink világát!
            </h1>

            <p class="text-lg text-gray-300 max-w-2xl mb-8">
                Böngéssz a sütemények között, ismerd meg az áraikat és
                tájékozódj a különböző mentességekről egy helyen.
            </p>

            <a href="{{ route('adatbazis') }}"
               class="inline-block bg-teal-600 hover:bg-teal-500 text-white font-semibold py-3 px-6 rounded-lg">
                Sütemények megtekintése
            </a>
        </section>

        <section class="mt-10">
            <h2 class="text-2xl font-bold text-white mb-6">
                Fedezd fel az oldalt
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <a href="{{ route('adatbazis') }}"
                   class="block bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6">
                    <span class="text-3xl">🍰</span>
                    <h3 class="text-xl font-bold text-white mt-4 mb-2">
                        Süteményeink
                    </h3>
                    <p class="text-gray-300">
                        Böngéssz a sütemények, áraik és mentességeik között.
                    </p>
                </a>

                <a href="{{ route('diagram') }}"
                   class="block bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6">
                    <span class="text-3xl">📊</span>
                    <h3 class="text-xl font-bold text-white mt-4 mb-2">
                        Kínálatunk számokban
                    </h3>
                    <p class="text-gray-300">
                        Nézd meg a süteménytípusok megoszlását diagramon.
                    </p>
                </a>

                <a href="{{ route('kapcsolat') }}"
                   class="block bg-gray-800 hover:bg-gray-700 border border-gray-700 rounded-xl p-6">
                    <span class="text-3xl">✉️</span>
                    <h3 class="text-xl font-bold text-white mt-4 mb-2">
                        Lépj kapcsolatba velünk
                    </h3>
                    <p class="text-gray-300">
                        Kérdésed van? Küldj nekünk üzenetet az űrlapon.
                    </p>
                </a>
            </div>
        </section>
    </div>
@endsection