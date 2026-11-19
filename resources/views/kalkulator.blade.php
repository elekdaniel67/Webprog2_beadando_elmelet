@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-3">
            Kedvezménykalkulátor
        </h1>

        <p class="text-gray-300 mb-6">
            Add meg az árat és a kedvezményt, és kiszámoljuk a fizetendő összeget.
        </p>

        <form action="{{ route('teszt.szamol') }}"
              method="POST"
              class="bg-gray-800 p-6 rounded-lg space-y-5">
            @csrf

            <div>
                <label for="ar" class="block text-white mb-2">
                    Eredeti ár (Ft)
                </label>

                <input type="number"
                       id="ar"
                       name="ar"
                       value="{{ old('ar', $adatok['ar'] ?? '') }}"
                       min="0"
                       step="0.01"
                       required
                       class="w-full rounded bg-white text-gray-900 border-gray-600">

                @error('ar')
                    <p class="text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kedvezmeny" class="block text-white mb-2">
                    Kedvezmény (%)
                </label>

                <input type="number"
                       id="kedvezmeny"
                       name="kedvezmeny"
                       value="{{ old('kedvezmeny', $adatok['kedvezmeny'] ?? '') }}"
                       min="0"
                       max="100"
                       step="0.01"
                       required
                       class="w-full rounded bg-white text-gray-900 border-gray-600">

                @error('kedvezmeny')
                    <p class="text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-teal-600 hover:bg-teal-500 text-white font-semibold py-3 px-6 rounded">
                Számolás
            </button>
        </form>

        @isset($eredmeny)
            <div class="mt-6 bg-gray-800 border border-teal-600 p-6 rounded-lg">
                <p class="text-gray-300">Fizetendő összeg:</p>
                <p class="text-3xl font-bold text-teal-400 mt-2">
                    {{ number_format($eredmeny, 2, ',', ' ') }} Ft
                </p>
            </div>
        @endisset
    </div>
@endsection