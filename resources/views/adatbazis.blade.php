@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6">
        <h1 class="text-2xl font-bold text-white mb-6">Cukrászda Teljes Adatbázisa</h1>

        <div class="bg-gray-800 shadow rounded-lg overflow-hidden border border-gray-700">
            <table class="min-w-full divide-y divide-gray-700 text-left text-gray-300">
                <thead class="bg-gray-900 text-xs uppercase font-semibold text-gray-400">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Név</th>
                        <th class="px-4 py-3">Típus</th>
                        <th class="px-4 py-3">Díj</th>
                        <th class="px-4 py-3">Árak / Egységek</th>
                        <th class="px-4 py-3">Mentesség / Tartalom</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 text-sm">
                    @forelse($sutik ?? [] as $suti)
                        <tr class="hover:bg-gray-750 transition">
                            <td class="px-4 py-4 whitespace-nowrap text-gray-400">{{ $suti->id }}</td>
                            <td class="px-4 py-4 whitespace-nowrap font-medium text-white">{{ $suti->nev }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $suti->tipus }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">{{ $suti->dijazott }}</td>
                            
                            <!-- Árak megjelenítése -->
                            <td class="px-4 py-4">
                                @if(isset($arak[$suti->id]))
                                    <ul class="space-y-1 text-xs">
                                        @foreach($arak[$suti->id] as $ar)
                                            <li><span class="text-teal-400 font-semibold">{{ $ar->ertek }} Ft</span> <span class="text-gray-400">({{ $ar->egyseg }})</span></li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500 text-xs">-</span>
                                @endif
                            </td>

                            <!-- Tartalom / Mentesség megjelenítése -->
                            <td class="px-4 py-4">
                                @if(isset($tartalmak[$suti->id]))
                                    @foreach($tartalmak[$suti->id] as $tartalom)
                                        <span class="inline-block bg-teal-900 text-teal-200 text-xs px-2 py-0.5 rounded font-bold mr-1">{{ $tartalom->mentes }}</span>
                                    @endforeach
                                @else
                                    <span class="text-gray-500 text-xs">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-400">Még nincsenek feltöltve adatok az adatbázisba.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection