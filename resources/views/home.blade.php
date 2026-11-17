@extends('layouts.app')

@section('content')
    <section class="max-w-4xl mx-auto py-12">
        <h1 class="text-4xl font-bold text-white mb-6">
            Üdvözlünk a cukrászdánk oldalán!
        </h1>

        <p class="text-lg text-gray-300 mb-4">
            Fedezd fel süteményeinket, nézd meg az áraikat,
            és tájékozódj a különböző mentességekről!
        </p>

        <p class="text-gray-300 mb-8">
            Az Adatbázis menüpontban összegyűjtöttük a kínálatunkkal
            kapcsolatos információkat.
        </p>

        <a href="{{ route('adatbazis') }}"
           class="inline-block bg-teal-600 hover:bg-teal-500 text-white font-semibold py-3 px-6 rounded-md">
            Sütemények megtekintése
        </a>
    </section>
@endsection