@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Üzenetek</h1>

        <div class="overflow-x-auto bg-gray-800 rounded-lg">
            <table class="min-w-full text-left text-gray-300">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="px-4 py-3">Küldés ideje</th>
                        <th class="px-4 py-3">Név</th>
                        <th class="px-4 py-3">E-mail-cím</th>
                        <th class="px-4 py-3">Üzenet</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($uzenetek as $uzenet)
                        <tr class="border-t border-gray-700">
                            <td class="px-4 py-3">
                                {{ $uzenet->created_at->format('Y.m.d. H:i') }}
                            </td>
                            <td class="px-4 py-3">{{ $uzenet->nev }}</td>
                            <td class="px-4 py-3">{{ $uzenet->email }}</td>
                            <td class="px-4 py-3">{{ $uzenet->uzenet }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center">
                                Még nem érkezett üzenet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection