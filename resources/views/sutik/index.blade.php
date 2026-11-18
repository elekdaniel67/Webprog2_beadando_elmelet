@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold text-white">
                Sütemények kezelése
            </h1>

            <a href="{{ route('sutik.create') }}"
               class="bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2 px-4 rounded">
                Új sütemény
            </a>
        </div>

        @if (session('siker'))
            <div class="bg-green-800 text-white p-4 rounded mb-6">
                {{ session('siker') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-gray-800 rounded-lg">
            <table class="min-w-full text-left text-gray-300">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="px-4 py-3">Név</th>
                        <th class="px-4 py-3">Típus</th>
                        <th class="px-4 py-3">Díjazott</th>
                        <th class="px-4 py-3">Műveletek</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sutik as $suti)
                        <tr class="border-t border-gray-700">
                            <td class="px-4 py-3">{{ $suti->nev }}</td>
                            <td class="px-4 py-3">{{ $suti->tipus }}</td>
                            <td class="px-4 py-3">
                                {{ $suti->dijazott ? 'Igen' : 'Nem' }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap items-center gap-3">
                                    <a href="{{ route('sutik.edit', $suti) }}"
                                       class="text-teal-400 hover:text-teal-300">
                                        Szerkesztés
                                    </a>

                                    <form action="{{ route('sutik.destroy', $suti) }}"
                                          method="POST"
                                          onsubmit="return confirm('Biztosan törlöd ezt a süteményt és a hozzá tartozó árakat, mentességeket?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-400 hover:text-red-300">
                                            Törlés
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center">
                                Még nincsenek sütemények az adatbázisban.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection