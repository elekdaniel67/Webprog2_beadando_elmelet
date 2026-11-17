@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Kapcsolat</h1>

        <p class="text-gray-300 mb-6">
            Írj nekünk üzenetet az alábbi űrlapon!
        </p>

        @if (session('siker'))
            <div class="bg-green-800 text-white p-4 rounded mb-6">
                {{ session('siker') }}
            </div>
        @endif

        <form action="{{ route('kapcsolat.kuldes') }}"
              method="POST"
              class="bg-gray-800 p-6 rounded-lg space-y-5">
            @csrf

            <div>
                <label for="nev" class="block text-white mb-2">
                    Név
                </label>

                <input type="text"
                       id="nev"
                       name="nev"
                       value="{{ old('nev') }}"
                       required
                       maxlength="255"
                       class="w-full rounded bg-white text-gray-900 border-gray-600">

                @error('nev')
                    <p class="text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-white mb-2">
                    E-mail-cím
                </label>

                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       maxlength="255"
                       class="w-full rounded bg-white text-gray-900 border-gray-600">

                @error('email')
                    <p class="text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="uzenet" class="block text-white mb-2">
                    Üzenet
                </label>

                <textarea id="uzenet"
                          name="uzenet"
                          rows="5"
                          required
                          maxlength="5000"
                          class="w-full rounded bg-white text-gray-900 border-gray-600">{{ old('uzenet') }}</textarea>

                @error('uzenet')
                    <p class="text-red-400 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-teal-600 hover:bg-teal-500 text-white font-semibold py-3 px-6 rounded">
                Üzenet küldése
            </button>
        </form>
    </div>
@endsection